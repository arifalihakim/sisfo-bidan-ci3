<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        if (is_role(1)) {
            redirect('user');
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard"; 
        $data['jumlah'] = [];
        $tables = ['pasien', 'obat', 'periksa', 'registrasi'];
        foreach ($tables as $table) {
            $data['jumlah'][$table] = $this->MainModel->count($table);
        }

        $data['periksa'] = $this->PeriksaModel->getPeriksaHariIni();

        $data['jumlah_periksa_hari_ini'] = $this->PeriksaModel->getPeriksaToday();

        $data['jumlah_registrasi_hari_ini'] = $this->RegistrasiModel->getRegistrasiToday();

        $data['pr'] = [];
        for ($i = 1; $i <= 12; $i++) {
            $date = date('Y-') . sprintf("%02d", $i);
            $data['pr'][] = $this->PeriksaModel->chartPeriksa($date);
        }

        template_view('admin/dashboard', $data);
    }

    public function blocked()
    {
        $data['title'] = "Not Found";
        template_view('admin/blocked', $data);
    }
}