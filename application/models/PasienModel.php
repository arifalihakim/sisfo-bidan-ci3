<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PasienModel extends CI_Model
{

	public function getPasienByDate($tgl1, $tgl2)
    {
        $this->db->select('p.*');
        $this->db->from('pasien p');
        $this->db->where('p.tglDaftar >=', $tgl1);
        $this->db->where('p.tglDaftar <=', $tgl2);
        return $this->db->get()->result();
    }
 
}