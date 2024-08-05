<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sepak_bola extends CI_Model
{
    public function data_club()
    {
        $qdata = $this->db->get('app_klub');
        return $qdata->result();
    }
    public function input_klub($data)
    {
        $this->db->insert('app_klub', $data);
    }

    public function match_sama($klub1, $klub2)
    {
        $this->db->where("(klub1 = $klub1 AND klub2 = $klub2) OR (klub1 = $klub2 AND klub2 = $klub1)");
        $qjum = $this->db->get('app_skor');
        return $qjum->num_rows();
    }

    public function view_klasemen()
    {
        $qdata = $this->db->get('app_klub');
        return $qdata->result();
    }
}
