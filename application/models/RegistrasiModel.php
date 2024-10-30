<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegistrasiModel extends CI_Model
{
	public function getRegistrasi($where = null)
    {
        $this->db->select('r.*, p.*, u.*');
        $this->db->from('registrasi r');
        $this->db->join('pasien p', 'r.noRm = p.noRm');
        $this->db->join('user u', 'r.idUser = u.idUser');
        $this->db->where('DATE(r.tglKunjungan)', 'CURDATE()', FALSE);
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('r.tglKunjungan', 'desc');
        if ($where != null) {
            return $this->db->get()->row();
        } else {
            return $this->db->get()->result();
        }
    }

    public function cekRegistrasiHariIni($noRm)
    {
        // Lakukan pencarian entri registrasi untuk nomor rekam medis yang dipilih hari ini
        $this->db->where('noRm', $noRm);
        $this->db->where('DATE(tglKunjungan)', 'CURDATE()', FALSE);
        $query = $this->db->get('registrasi');
        
        // Jika ada hasil, kembalikan true (sudah terdaftar), jika tidak, kembalikan false
        return $query->num_rows() > 0;
    }

    public function getRegistrasiToday()
    {
        $this->db->where('DATE(tglKunjungan) = CURDATE()', NULL, FALSE);
        return $this->db->count_all_results('registrasi');
    }

    public function getPeriksaIdByRegistrasi($noRegistrasi)
    {
        $this->db->select('idPeriksa');
        $this->db->from('periksa');
        $this->db->where('noRegistrasi', $noRegistrasi);
        $query = $this->db->get();

        // Jika ada hasil, kembalikan ID periksa
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->idPeriksa;
        } else {
            return false;
        }
    }

    public function getRegistrasiByDate($tgl1, $tgl2)
    {
        $this->db->select('r.noRegistrasi, r.noRm, p.noIdentitas, p.nmPasien, r.tglKunjungan');
        $this->db->from('registrasi r');
        $this->db->join('pasien p', 'r.noRm = p.noRm');
        $this->db->where('r.tglKunjungan >=', $tgl1);
        $this->db->where('r.tglKunjungan <=', $tgl2);
        return $this->db->get()->result();
    }


    // public function resepExistsOnRegistrasi($kdObat)
    // {
    //     $this->db->where('kdObat', $kdObat);
    //     $query = $this->db->get('pr_obat');
    //     return $query->num_rows() > 0;
    // }

}