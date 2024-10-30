<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('numeric', 'Kolom {field} hanya bisa diisi oleh angka');

        // Jika bukan admin block
        is_role(2, true);
    }

    public function index()
    {
        $data['title'] = "Registrasi Pasien / Ibu Hamil";
        $data['registrasi'] = $this->RegistrasiModel->getRegistrasi();
        template_view('registrasi/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('noRm', 'Pasien', 'required');
    }

    private function _generateNoReg()
    {
        // ID2024021700001
        $char = "ID";
        $table = "registrasi";
        $field = "noRegistrasi";
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Ymd');
        $prefix = $char.$today;

        $lastKode = $this->MainModel->getId($prefix, $table, $field);
        $noUrut = (int) substr($lastKode, -5, 5);
        $noUrut++;

        $newKode = $char.$today.sprintf('%05s', $noUrut);
        return $newKode;
    }

    public function add()
    {
        $data['title'] = "Register Pasien / Ibu Hamil";
        $data['noRegistrasi'] = $this->_generateNoReg();

        $data['data'] = [];
        $tables = ['pasien'];
        foreach ($tables as $table) {
            $data['data'][$table] = $this->MainModel->get($table);
        }

        $this->_validasi();
        if ($this->form_validation->run() == false) {
            template_view('registrasi/add', $data);
        } else {
            $input = $this->input->post(null, true);
            if ($this->RegistrasiModel->cekRegistrasiHariIni($input['noRm'])) {
                msgBox('saveRegister', false);
                redirect('registrasi/add');
        }
            $save = $this->MainModel->insert('registrasi', $input);
            if ($save) {
                msgBox('saveRegister');
            } else {
                msgBox('save', false);
                redirect('registrasi/add');
            }
            redirect('registrasi');
        }
    }

    public function delete($noReg)
    {
        $id = encode_php_tags($noReg);
        $del = $this->MainModel->delete('registrasi', ['noRegistrasi' => $id]);
        if ($del) {
            msgBox('delete');
        } else {
            msgBox('delBlock', false);
        }
        redirect('registrasi');
    }

    public function filterByDate()
    {
        $tgl1 = $this->input->post('tgl1');
        $tgl2 = $this->input->post('tgl2');
        $data['title'] = "Registrasi Pasien / Ibu Hamil";
        $data['registrasi'] = $this->RegistrasiModel->getRegistrasiByDate($tgl1, $tgl2);
        $data['tgl1'] = $tgl1;
        $data['tgl2'] = $tgl2;
        template_view('registrasi/data', $data);
    }
}