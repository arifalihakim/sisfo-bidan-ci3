<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ObatModel extends CI_Model {
    
    public function get_stok_obat_masuk() {
        $this->db->select('id, kdObat, jumlah, tanggal');
        $this->db->from('stok_obat_masuk');
        return $this->db->get()->result();
    }

    public function get_stok_obat_keluar() {
        $this->db->select('id, kdObat, jumlah, idPeriksa, tanggal');
        $this->db->from('stok_obat_keluar');
        return $this->db->get()->result();
    }
}
?>
