<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PeriksaModel extends CI_Model
{

	public function getPeriksa($where = null)
    {
        $this->db->select('pr.*, r.*, p.*, u.*');
        $this->db->from('periksa pr');
        $this->db->join('registrasi r', 'pr.noRegistrasi = r.noRegistrasi');
        $this->db->join('pasien p', 'pr.noRm = p.noRm');
        $this->db->join('user u', 'pr.idUser = u.idUser');
        $this->db->where('DATE(pr.created)', 'CURDATE()', FALSE);
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('pr.created', 'desc');
        if ($where != null) {
            return $this->db->get()->row();
        } else {
            return $this->db->get()->result();
        }
    }

    public function getPeriksaByDate($tgl1, $tgl2)
    {
        $this->db->select('pr.*, r.*, p.*, u.*');
        $this->db->from('periksa pr');
        $this->db->join('registrasi r', 'pr.noRegistrasi = r.noRegistrasi');
        $this->db->join('pasien p', 'pr.noRm = p.noRm');
        $this->db->join('user u', 'pr.idUser = u.idUser');
        $this->db->where('pr.created >=', $tgl1);
        $this->db->where('pr.created <=', $tgl2);
        return $this->db->get()->result();
    }

    public function getPeriksaHariIni($where = null)
    {
        $this->db->select('pr.*, r.*, p.*, u.*');
        $this->db->from('periksa pr');
        $this->db->join('registrasi r', 'pr.noRegistrasi = r.noRegistrasi');
        $this->db->join('pasien p', 'pr.noRm = p.noRm');
        $this->db->join('user u', 'pr.idUser = u.idUser');
        
        $this->db->where('DATE(pr.created)', 'CURDATE()', FALSE);
        
        if ($where != null) {
            $this->db->where($where);
        }
        
        $this->db->order_by('pr.created', 'desc');
        
        if ($where != null) {
            return $this->db->get()->row();
        } else {
            return $this->db->get()->result();
        }
    }


    public function getPeriksaByNoRm($noRm)
    {
        $this->db->select('periksa.*, pasien.nmPasien, GROUP_CONCAT(obat.nmObat SEPARATOR ", ") AS obat');
        $this->db->from('periksa');
        $this->db->join('pasien', 'periksa.noRm = pasien.noRm');
        $this->db->join('pr_obat', 'periksa.idPeriksa = pr_obat.idPeriksa', 'left');
        $this->db->join('obat', 'pr_obat.kdObat = obat.kdObat', 'left');
        $this->db->where('periksa.noRm', $noRm)
                ->group_by('periksa.idPeriksa')
                ->order_by('periksa.created', 'DESC');
        return $this->db->get()->result();
    }

    public function getPeriksaById($idPeriksa)
    {
        $this->db->where('idPeriksa', $idPeriksa);
        return $this->db->get('periksa')->row();
    }

    public function getPeriksaToday()
    {
        $this->db->where('DATE(tglPeriksa) = CURDATE()', NULL, FALSE);
        return $this->db->count_all_results('periksa');
    }

    public function getObatPR($where)
    {
        $this->db->select('o.nmObat, o.hargaObat, pro.jumlahObat, pro.aturan');
        $this->db->join('obat o', 'o.kdObat=pro.kdObat');
        return $this->db->get_where('pr_obat pro', $where);
    }
    public function cekStokObat($kdObat)
    {
        $this->db->select('stok');
        $this->db->from('obat');
        $this->db->where('kdObat', $kdObat);
        $query = $this->db->get();
        return $query->row()->stok;
    }
    public function sumObat($where)
    {
        $this->db->select('SUM(o.hargaObat * pro.jumlahObat) as total_harga_obat');
        $this->db->join('obat o', 'o.kdObat = pro.kdObat');
        $this->db->where($where);
        return $this->db->get('pr_obat pro')->row()->total_harga_obat;
    }

    public function resepExistsOnPeriksa($idPeriksa)
    {
        $this->db->where('idPeriksa', $idPeriksa);
        $query = $this->db->get('pr_obat');
        return $query->num_rows() > 0;
    }

    public function decreaseStokObat($kdObat, $jumlah)
    {
        $this->db->set('stok', 'stok - ' . (int)$jumlah, false);
        $this->db->where('kdObat', $kdObat);
        $this->db->update('obat');
    }

    public function chartPeriksa($date)
    {
        $this->db->like('tglPeriksa', $date, 'after');
        $result = $this->db->get('periksa');
        return $result->num_rows();
    }

}
