<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi');
        $this->form_validation->set_message('numeric', 'Kolom {field} hanya bisa diisi oleh angka');

        // Jika bukan admin block
        is_role(2, true);
    }

    public function index()
    {
        $data['title'] = "Data Pasien";
        $data['pasien'] = $this->MainModel->get('pasien');
        template_view('pasien/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('noIdentitas', 'No KTP/ KK', 'required');
        $this->form_validation->set_rules('nmSuami', 'Nama Pasien', 'required|trim');
        $this->form_validation->set_rules('nmPasien', 'Nama Pasien', 'required|trim');
        $this->form_validation->set_rules('tglLahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('noTelp', 'Nomor Telepon', 'required|numeric');
    }

    private function _generateNoRm()
    {
        // Buat No RM Otomatis
        // RM000001
        $char = "RM"; 
        $table = "pasien";
        $field = "noRm";
        $prefix = $char;

        $lastKode = $this->MainModel->getId($prefix, $table, $field);
        $noUrut = (int) substr($lastKode, -6, 6); //get 6 angka norm terakhir (000001)
        $noUrut++;

        $newKode = $char.sprintf('%06s', $noUrut);
        return $newKode;
    }

    public function add()
    {
        $data['title'] = "Tambah Data Pasien / Ibu Hamil";
        $data['noRm'] = $this->_generateNoRm();

        $data['data'] = [];
        $tables = ['pasien'];
        foreach ($tables as $table) {
            $data['data'][$table] = $this->MainModel->get($table);
        }

        $this->_validasi();
        if ($this->form_validation->run() == false) {
            template_view('pasien/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $save = $this->MainModel->insert('pasien', $input);
            if ($save) {
                msgBox('save');
            } else {
                msgBox('save', false);
                redirect('pasien/add');
            }
            redirect('pasien');
        }
    }

    public function edit($noRm)
    {
        $id = encode_php_tags($noRm);
        $data['title'] = "Edit Data Pasien / Ibu Hamil";
        $data['pasien'] = $this->MainModel->get_where('pasien', ['noRm' => $id]);
        $this->_validasi(); 
        if ($this->form_validation->run() == false) {
            template_view('pasien/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $edit = $this->MainModel->update('pasien', $input, ['noRm' => $id]);
            if ($edit) {
                msgBox('edit');
                redirect('pasien');
            } else {
                msgBox('edit', false);
                redirect('pasien/edit/'.$pasienId);
            }
        }
    }

    public function delete($noRm)
    {
        $id = encode_php_tags($noRm);
        $del = $this->MainModel->delete('pasien', ['noRm' => $id]);
        if ($del) {
            msgBox('delete');
        } else {
            msgBox('delBlock', false);
        }
        redirect('pasien');
    }

    public function pasienView($noRm)
    {
        // get data periksa by noRm
        $data['title'] = "Riwayat Pemeriksaan";
        $data['pasienView'] = $this->PeriksaModel->getPeriksaByNoRm($noRm);
        $data['noRm'] = $noRm;
        
        template_view('pasien/pasienView', $data);
    }

}