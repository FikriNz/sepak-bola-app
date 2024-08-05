<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sepak_bola', 'm_sepakbola');
    }
    public function index()
    {
        $data = [
            'title'        => 'App Sepak Bola',
            'content'      => 'view_klasemen'
        ];
        $this->load->view('layouts/wrapper', $data);
    }

    public function add_club()
    {
        $this->form_validation->set_rules(
            'nama_klub',
            'Nama Klub',
            'trim|required|is_unique[app_klub.nama_klub]',
            [
                'required' => 'Nama Klub tidak boleh kosong!',
                'is_unique' => 'Nama Klub Sudah ada!'
            ]
        );
        $this->form_validation->set_rules(
            'kota_klub',
            'Kota Klub',
            'trim|required',
            [
                'required' => 'Kota Klub tidak boleh kosong!',
            ]
        );
        if ($this->form_validation->run() == false) {
            $data = [
                'title'        => 'Add Klub Sepak Bola',
                'content'      => 'add_club'
            ];
            $this->load->view('layouts/wrapper', $data);
        } else {
            $nama_klub   = htmlspecialchars($this->input->post('nama_klub', ENT_QUOTES));
            $kota_klub   = htmlspecialchars($this->input->post('kota_klub', ENT_QUOTES));

            $data = [
                'nama_klub' => $nama_klub,
                'kota_klub' => $kota_klub
            ];

            $this->m_sepakbola->input_klub($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect('home/add_club');
        }
    }

    public function add_skor()
    {
        $this->form_validation->set_rules('nama_klub1', 'Nama Klub 1', 'trim|required', ['required' => 'Nama Klub 1 tidak boleh kosong']);
        $this->form_validation->set_rules('nama_klub2', 'Nama Klub 2', 'trim|required', ['required' => 'Nama Klub 2 tidak boleh kosong']);
        $this->form_validation->set_rules('skor_klub1', 'Skor Klub 1', 'trim|required|numeric', ['required' => 'Skor Klub 1 tidak boleh kosong']);
        $this->form_validation->set_rules('skor_klub2', 'Skor Klub 2', 'trim|required|numeric', ['required' => 'Nama Klub 2 tidak boleh kosong']);

        if ($this->form_validation->run() == false) {
            $data_klub  = $this->m_sepakbola->data_club();
            $data = [
                'title'         => 'Add Skor Sepak Bola',
                'club'          => $data_klub,
                'content'       => 'add_skor'
            ];
            $this->load->view('layouts/wrapper', $data);
        } else {
            $klub1 = htmlspecialchars($this->input->post('nama_klub1', ENT_QUOTES));
            $klub2 = htmlspecialchars($this->input->post('nama_klub2', ENT_QUOTES));
            $skor1 = htmlspecialchars($this->input->post('skor_klub1', ENT_QUOTES));
            $skor2 = htmlspecialchars($this->input->post('skor_klub2', ENT_QUOTES));

            if ($klub1 == $klub2) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Data klub 1 dan klub 2 tidak boleh sama!</div>');
                redirect('home/add_skor');
            }

            // CEK PERTANDINGAN JIKA ADA YANG SAMA
            $jum = $this->m_sepakbola->match_sama($klub1, $klub2);
            // echo $jum;
            if ($jum >= 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data pertandingan tidak boleh sama!</div>');
                redirect('home/add_skor');
            }
            // CEK JIKA MENANG
            if ($skor1 > $skor2) {
                $qclub1 = $this->db->get_where('app_klub', ['rowid' => $klub1])->row_array();
                $qclub2 = $this->db->get_where('app_klub', ['rowid' => $klub2])->row_array();
                $main1          = $qclub1['main'] + 1;
                $menang1        = $qclub1['menang'] + 1;
                $goal_menang1   = $qclub1['goal_menang'] + $skor1;
                $point1         = $qclub1['point'] + 3;

                $main2          = $qclub2['main'] + 1;
                $kalah2         = $qclub2['kalah'] + 1;
                $goal_kalah2    = $qclub2['goal_kalah'] + $skor1;
                $point2         = $qclub2['point'] + 0;
                // POINT
                $where_menang = [
                    'rowid'     => $klub1
                ];
                $update_menang = [
                    'main'          => $main1,
                    'menang'        => $menang1,
                    'goal_menang'   => $goal_menang1,
                    'point'         => $point1,
                    // 'klub'          => $qclub1['nama_klub']
                ];
                $where_kalah = [
                    'rowid'     => $klub2
                ];
                $update_kalah = [
                    'main'          => $main2,
                    'kalah'         => $kalah2,
                    'goal_kalah'    => $goal_kalah2,
                    'point'         => $point2,
                    // 'klub'          => $qclub2['nama_klub']
                ];
                // SKOR
                $data = [
                    'klub1' => $klub1,
                    'klub2'  => $klub2,
                    'skor1'  => $skor1,
                    'skor2'  => $skor2,
                ];
                // echo "<pre>";
                // print_r($update_menang);
                // echo "</pre>";
                // echo "<pre>";
                // print_r($update_kalah);
                // echo "</pre>";
                $this->db->insert('app_skor', $data);
                $this->db->set($update_kalah);
                $this->db->where($where_kalah);
                $this->db->update('app_klub');
                $this->db->set($update_menang);
                $this->db->where($where_menang);
                $this->db->update('app_klub');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Skor berhasil di simpan!</div>');
                redirect('home/add_skor');
            } else if ($skor1 < $skor2) {
                $qclub2 = $this->db->get_where('app_klub', ['rowid' => $klub2])->row_array();
                $qclub1 = $this->db->get_where('app_klub', ['rowid' => $klub1])->row_array();
                $main2          = $qclub2['main'] + 1;
                $menang2        = $qclub2['menang'] + 1;
                $goal_menang2   = $qclub2['goal_menang'] + $skor2;
                $point2         = $qclub2['point'] + 3;

                $main1          = $qclub1['main'] + 1;
                $kalah1         = $qclub1['kalah'] + 1;
                $goal_kalah1    = $qclub1['goal_kalah'] + $skor2;
                $point1         = $qclub1['point'] + 0;
                // POINT
                $where_menang = [
                    'rowid'     => $klub2
                ];
                $update_menang = [
                    'main'          => $main2,
                    'menang'        => $menang2,
                    'goal_menang'   => $goal_menang2,
                    'point'         => $point2,
                    // 'klub'          => $qclub2['nama_klub']
                ];
                $where_kalah = [
                    'rowid'     => $klub1
                ];
                $update_kalah = [
                    'main'          => $main1,
                    'kalah'         => $kalah1,
                    'goal_kalah'    => $goal_kalah1,
                    'point'         => $point1,
                    // 'klub'          => $qclub1['nama_klub']
                ];
                // SKOR
                $data = [
                    'klub1' => $klub1,
                    'klub2'  => $klub2,
                    'skor1'  => $skor1,
                    'skor2'  => $skor2,
                ];
                // echo "<pre>";
                // print_r($update_menang);
                // echo "</pre>";
                // echo "<pre>";
                // print_r($update_kalah);
                // echo "</pre>";
                $this->db->insert('app_skor', $data);
                $this->db->set($update_kalah);
                $this->db->where($where_kalah);
                $this->db->update('app_klub');
                $this->db->set($update_menang);
                $this->db->where($where_menang);
                $this->db->update('app_klub');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Skor berhasil di simpan!</div>');
                redirect('home/add_skor');
            } else {
                $qclub2 = $this->db->get_where('app_klub', ['rowid' => $klub2])->row_array();
                $qclub1 = $this->db->get_where('app_klub', ['rowid' => $klub1])->row_array();
                $main2          = $qclub2['main'] + 1;
                $seri2          = $qclub2['seri'] + 1;
                $goal_menang2   = $qclub2['goal_menang'] + $skor1;
                $goal_kalah2    = $qclub2['goal_kalah'] + $skor1;
                $point2         = $qclub2['point'] + 1;

                $main1          = $qclub1['main'] + 1;
                $seri1          = $qclub1['seri'] + 1;
                $goal_menang1   = $qclub1['goal_menang'] + $skor2;
                $goal_kalah1    = $qclub1['goal_kalah'] + $skor2;
                $point1         = $qclub1['point'] + 1;
                // POINT
                $where1 = ['rowid'  => $klub2];
                $where2 = ['rowid'  => $klub1];

                $update_1 = [
                    'main'          => $main2,
                    'seri'          => $seri2,
                    'goal_menang'   => $goal_menang2,
                    'goal_kalah'   => $goal_kalah2,
                    'point'         => $point2,
                    // 'klub'          => $qclub2['nama_klub']
                ];
                $update_2 = [
                    'main'          => $main1,
                    'seri'          => $seri1,
                    'goal_menang'   => $goal_menang1,
                    'goal_kalah'   => $goal_kalah1,
                    'point'         => $point1,
                    // 'klub'          => $qclub1['nama_klub']
                ];
                // SKOR
                $data = [
                    'klub1' => $klub1,
                    'klub2'  => $klub2,
                    'skor1'  => $skor1,
                    'skor2'  => $skor2,
                ];
                // echo "<pre>";
                // print_r($where2);
                // echo "</pre>";
                // echo "<pre>";
                // print_r($update_2);
                // echo "</pre>";
                $this->db->insert('app_skor', $data);
                $this->db->set($update_1);
                $this->db->where($where1);
                $this->db->update('app_klub');
                $this->db->set($update_2);
                $this->db->where($where2);
                $this->db->update('app_klub');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Skor berhasil di simpan!</div>');
                redirect('home/add_skor');
            }
        }
    }

    public function add_skor_multipe()
    {
        $this->form_validation->set_rules('nama_klub1[]', 'Nama Klub 1', 'trim|required', ['required' => 'Nama Klub 1 tidak boleh kosong']);
        $this->form_validation->set_rules('nama_klub2[]', 'Nama Klub 2', 'trim|required', ['required' => 'Nama Klub 2 tidak boleh kosong']);
        $this->form_validation->set_rules('skor_klub1[]', 'Skor Klub 1', 'trim|required|numeric', ['required' => 'Skor Klub 1 tidak boleh kosong']);
        $this->form_validation->set_rules('skor_klub2[]', 'Skor Klub 2', 'trim|required|numeric', ['required' => 'Skor Klub 2 tidak boleh kosong']);
        if ($this->form_validation->run() == false) {
            $data_klub  = $this->m_sepakbola->data_club();
            $data = [
                'title'         => 'Add Skor Sepak Bola',
                'club'          => $data_klub,
                'content'       => 'add_skor_multiple'
            ];
            $this->load->view('layouts/wrapper', $data);
        } else {
            $nama_klub1 = $this->input->post('nama_klub1');
            $nama_klub2 = $this->input->post('nama_klub2');
            $skor_klub1 = $this->input->post('skor_klub1');
            $skor_klub2 = $this->input->post('skor_klub2');

            foreach ($nama_klub1 as $index => $klub1) {
            }
        }
    }

    public function view_klasemen()
    {
        $data = $this->m_sepakbola->view_klasemen();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        $data = [
            'title'         => 'View Klasemen Sepak Bola',
            'data'          => $data,
            'content'       => 'view_klasemen'
        ];
        $this->load->view('layouts/wrapper', $data);
    }
}
