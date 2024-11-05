<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        // Jika bukan bidan block
        is_role(2, true);
    }

    public function index()
    {
        $data['title'] = "Cetak Laporan Pemeriksaan Ibu Hamil";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi');
        $this->form_validation->set_message('numeric', 'Kolom {field} hanya bisa diisi oleh angka');

        if ($this->form_validation->run() == false) {
            template_view('laporan/index', $data);
        } else {
            $input  = $this->input->post(null, true);
            $tgl    = explode(' - ', $input['tanggal']);
            $tgl1   = date('Y-m-d', strtotime($tgl[0]));
            $tgl2   = date('Y-m-d', strtotime(end($tgl)));

            $this->periksa($tgl1, $tgl2);
        }
    }

    public function pasien()
    {
        $data['title'] = "Data Pasien";
        $data['pasien'] = $this->MainModel->get('pasien');
        $this->load->view('laporan/pasien/cetak_pasien',$data);
    }

    public function cetakRiwayatPeriksa($noRm)
    {
        // Mengambil data tabel periksa berdasarkan noRm
        $data['title'] = "Data Riwayat Pemeriksaan Pasien";
        $data['noRm'] = $noRm;
        $data['pasienView'] = $this->PeriksaModel->getPeriksaByNoRm($noRm);
        $this->load->view('laporan/pasien/cetak_riwayat_periksa',$data);
    }

    public function cetakMultipleKartuIbu($noRms)
    {
        $noRmArray = explode(',', $noRms);
        $data['title'] = "Cetak Kartu Ibu";
        $data['pasien_list'] = $this->MainModel->get_where_in('pasien', 'noRm', $noRmArray);
        $this->load->view('laporan/pasien/cetak_multiple_kartu', $data);
    }


    public function obat()
    {
        $data['title'] = "Data Obat";
        $data['obat'] = $this->MainModel->get('obat');
        $this->load->view('laporan/obat/cetak_obat',$data);
    }

    public function cetakObatMasuk()
    {
        $data['title'] = "Data Stok Obat Masuk";
        $data['stok_obat_masuk'] = $this->MainModel->get('stok_obat_masuk');
        $this->load->view('laporan/obat/cetak_obat_masuk',$data);
    }

    public function cetakObatKeluar()
    {
        $data['title'] = "Data Stok Obat Keluar";
        $data['stok_obat_keluar'] = $this->MainModel->get('stok_obat_keluar');
        $this->load->view('laporan/obat/cetak_obat_keluar',$data);
    }

    public function pasienFilter()
    {
        $data['title'] = "Laporan Data Obat";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi');

        if ($this->form_validation->run() == false) {
            redirect('pasien'); // Redirect to the page with the modal
        } else {
            $input = $this->input->post(null, true);
            $tgl = explode(' - ', $input['tanggal']);
            $tgl1 = date('Y-m-d', strtotime($tgl[0]));
            $tgl2 = date('Y-m-d', strtotime(end($tgl)));

            $data['pasien'] = $this->PasienModel->getPasienByDate($tgl1, $tgl2);
            $this->load->view('laporan/pasien/cetak_pasien', $data);
        }
    }


    public function cetakRegistrasi()
    {
        $data['title'] = "Laporan Registrasi";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi');

        if ($this->form_validation->run() == false) {
            redirect('registrasi'); // Redirect to the page with the modal
        } else {
            $input = $this->input->post(null, true);
            $tgl = explode(' - ', $input['tanggal']);
            $tgl1 = date('Y-m-d', strtotime($tgl[0]));
            $tgl2 = date('Y-m-d', strtotime(end($tgl)));

            $data['registrasi'] = $this->RegistrasiModel->getRegistrasiByDate($tgl1, $tgl2);
            $this->load->view('laporan/registrasi/cetak_registrasi', $data);
        }
    }


    public function periksa($tgl1 = null, $tgl2 = null)
    {
        $data['title'] = "Data Pemeriksaan";
        $data['tgl1'] = $tgl1;
        $data['tgl2'] = $tgl2;
        $this->db->select('*');
        $this->db->from('periksa');
        $this->db->join('pasien', 'pasien.noRm=periksa.noRm');
        $this->db->join('user', 'user.idUser=periksa.idUser');
        if ($tgl1 != null && $tgl2 != null) {
            $this->db->where('tglPeriksa' . ' >=', $tgl1);
            $this->db->where('tglPeriksa' . ' <=', $tgl2);
        }
        $data['periksa'] = $this->db->get()->result();
        $this->load->view('laporan/periksa/cetak_periksa',$data);
    }


    public function detailPr($prId)
    {
        $id = encode_php_tags($prId);
        $whereId = ['idPeriksa' => $id];
        $data['title']  = "Detail Pemeriksaan dan Resep Ibu Hamil";
        $data['detail'] = $this->PeriksaModel->getPeriksa($whereId);
        $data['obat']   = $this->PeriksaModel->getObatPR($whereId)->result();
        $this->load->view('laporan/periksa/cetak_detailPr',$data);
    }
    public function struk($strukId)
    {
        $id = encode_php_tags($strukId);
        $whereId = ['idPeriksa' => $id];
        $data['title'] = "Struk Biaya";
        $data['detail'] = $this->PeriksaModel->getPeriksa($whereId);
        $data['obat'] = $this->PeriksaModel->getObatPR($whereId)->result();

        // Rincian Biaya
        $data['biaya_pelayanan'] = $this->config->item('biaya_pelayanan');
        
        // Hitung total harga obat berdasarkan jumlah obat yang diinputkan
        $total_harga_obat = 0;
        foreach ($data['obat'] as $o) {
            $total_harga_obat += $o->hargaObat * $o->jumlahObat;
        }
        
        $data['total_harga'] = $total_harga_obat + $data['biaya_pelayanan'];
        
        $this->load->view('laporan/periksa/struk', $data);
    }


}
