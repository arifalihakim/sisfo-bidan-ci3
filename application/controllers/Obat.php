<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('numeric', 'Kolom {field} hanya bisa diisi oleh angka');

        // Jika bukan bidan block
        is_role(2, true);
    }

    public function index()
    {
        $data['title'] = "Data Obat";
        $data['obat'] = $this->MainModel->get('obat');
        $data['stok_obat_masuk'] = $this->MainModel->get('stok_obat_masuk');
        $data['stok_obat_keluar'] = $this->MainModel->get('stok_obat_keluar');
        template_view('obat/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nmObat', 'Nama Obat', 'required|trim');
        $this->form_validation->set_rules('hargaObat', 'Harga', 'required|trim|numeric');
        // $this->form_validation->set_rules('stok', 'Stok Obat', 'required|trim|numeric');
    }

    private function _generateKdObat()
    {
        // T01
        $char = "O";
        $table = "obat";
        $field = "kdObat";
        $prefix = $char;

        $lastKode = $this->MainModel->getId($prefix, $table, $field);
        $noUrut = (int) substr($lastKode, -2, 2);
        $noUrut++;

        $newKode = $char.sprintf('%02s', $noUrut);
        return $newKode;
    }

    public function add()
    {
        $data['title'] = "Tambah Obat";
        $data['kdObat'] = $this->_generateKdObat();

        $data['data'] = [];
        $tables = ['obat'];
        foreach ($tables as $table) {
            $data['data'][$table] = $this->MainModel->get($table);
        }

        $this->_validasi();
        if ($this->form_validation->run() == false) {
            template_view('obat/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $this->MainModel->insert('obat', $input);
            msgBox('save');
            redirect('obat');
        }
    }

    public function edit($obatKd)
    {
        $id = encode_php_tags($obatKd); // Mengamankan ID dari serangan XSS
        $data['title'] = "Edit Data Obat";
        $data['obat'] = $this->MainModel->get_where('obat', ['kdObat' => $id]);

        $this->_validasi();
        if ($this->form_validation->run() == false) {
            template_view('obat/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $edit = $this->MainModel->update('obat', $input, ['kdObat' => $id]);
            msgBox('edit');
            redirect('obat');
        }
    }

    public function tambahStok()
    {
        $kdObat = $this->input->post('kdObat');
        $jumlah = $this->input->post('jumlah');

        // Update stok di tabel obat
        $this->db->set('stok', 'stok+' . $jumlah, FALSE);
        $this->db->where('kdObat', $kdObat);
        $this->db->update('obat');

        // Masukkan data ke tabel stok_obat_masuk
        $data = [
            'kdObat' => $kdObat,
            'jumlah' => $jumlah,
        ];
        $this->db->insert('stok_obat_masuk', $data);

        redirect('obat');
    }

    public function delete($obatKd)
    {
        $id = encode_php_tags($obatKd);
        $del = $this->MainModel->delete('obat', ['kdObat' => $id]);
        if ($del) {
            msgBox('delete');
        } else {
            msgBox('delBlock', false);
        }
        redirect('obat');
    }
}