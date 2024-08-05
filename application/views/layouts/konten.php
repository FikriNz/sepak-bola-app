<?php if (!defined('BASEPATH')) exit('No direct access allowed');
if ($content) {
    $this->load->view($content);
} else {
    echo "<h2>Konten tidak ditemukan.</h2>";
}
