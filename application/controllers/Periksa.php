<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periksa extends CI_Controller
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
        $data['title'] = "Data Pemeriksaan";
        $data['periksa'] = $this->PeriksaModel->getPeriksa();
        template_view('periksa/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tglPeriksa', 'tglPeriksa', 'required|trim');
        $this->form_validation->set_rules('noRegistrasi', 'No Registrasi', 'required');
        $this->form_validation->set_rules('noRm', 'No RM', 'required');
        // $this->form_validation->set_rules('kia', 'KIA', 'required');
        $this->form_validation->set_rules('sistol', 'Sistol', 'required');
        $this->form_validation->set_rules('diastol', 'Diastol', 'required');
        $this->form_validation->set_rules('bb', 'BB', 'required');
        $this->form_validation->set_rules('uk', 'UK', 'required');
        $this->form_validation->set_rules('diagnosa', 'Diagnosa', 'required|trim');
        $this->form_validation->set_rules('keluhan', 'Keluhan', 'required|trim');
        $this->form_validation->set_rules('tindakLanjut', 'Diagnosa', 'required|trim');
    }
    private function _validasiResep()
    {
        $this->form_validation->set_rules('kdObat[]', 'Obat', 'required');
    }

    private function _generateId()
    {
        // PR2024021700001
        $char = "PR";
        $table = "periksa";
        $field = "idPeriksa";
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
        $data['title'] = "Tambah Pemeriksaan";
        $data['idPeriksa'] = $this->_generateId();
        $data['registrasi'] = $this->RegistrasiModel->getRegistrasi();

        // Ambil semua master data
        $data['data'] = [];
        $tables = ['pasien', 'registrasi'];
        foreach ($tables as $table) {
            $data['data'][$table] = $this->MainModel->get($table);
        }

        $this->_validasi();
        if ($this->form_validation->run() == false) {
            template_view('periksa/add', $data);
        } else {
            // Simpan ke tabel periksa
            $input = $this->input->post(null, true);
            unset($input['kdObat']);
            $this->MainModel->insert('periksa', $input);

            // Redirect ke halaman periksa
            msgBox('save');
            redirect('periksa');
        }
    }


    public function delete($prId)
    {
        $id = encode_php_tags($prId);
        $del = $this->MainModel->delete('periksa', ['idPeriksa' => $id]);
        if ($del) {
            msgBox('delete');
        } else {
            msgBox('delete', false);
        }
        redirect('periksa');
    }

    public function filterByDate()
    {
        $tgl1 = $this->input->post('tgl1');
        $tgl2 = $this->input->post('tgl2');
        $data['title'] = "Data Pemeriksaan";
        $data['periksa'] = $this->PeriksaModel->getPeriksaByDate($tgl1, $tgl2);
        $data['tgl1'] = $tgl1;
        $data['tgl2'] = $tgl2;
        template_view('periksa/data', $data);
    }

    public function detail($prId)
    {
        $id = encode_php_tags($prId);
        $whereId = ['idPeriksa' => $id];
        $data['title'] = "Detail Pemeriksaan dan Resep Ibu Hamil";
        $data['detail'] = $this->PeriksaModel->getPeriksa($whereId);
        $data['obat'] = $this->PeriksaModel->getObatPR($whereId)->result();

        // Rincian Biaya
        $data['biaya_pelayanan'] = $this->config->item('biaya_pelayanan');
        $total_obat = $this->PeriksaModel->sumObat($whereId);
        $data['total_harga'] = $total_obat + $data['biaya_pelayanan'];

        template_view('periksa/detail', $data);
    }

    public function tambahResep($prId)
    {
        $id = encode_php_tags($prId);
        $whereId = ['idPeriksa' => $id];
        $data['title'] = "Tambah Resep";
        $data['periksa'] = $this->PeriksaModel->getPeriksa($whereId);

        // Get Selected Obat
        $pr_obat = $this->MainModel->get_where('pr_obat', $whereId, true)->result_array();
        $data['pr_obat'] = array_column($pr_obat, 'kdObat');

        // Ambil master data
        $tables = ['obat', 'registrasi'];
        foreach ($tables as $table) {
            $data['data'][$table] = $this->MainModel->get($table);
        }

        $this->_validasiResep();
        if ($this->form_validation->run() == false) {
            template_view('periksa/tambahResep', $data);
        } else {
            // Simpan ke tabel periksa
            $input = $this->input->post(null, true);
            unset($input['kdObat'], $input['jumlahObat'], $input['aturan']);
            $this->MainModel->update('periksa', $input, $whereId);

            // Hapus tabel pr_obat berdasarkan id periksa
            $this->MainModel->delete('pr_obat', $whereId);

            // Simpan ke tabel pr_obat dan update stok obat di tabel obat
            $id_obat = $this->input->post('kdObat', true);
            $jumlah_obat = $this->input->post('jumlahObat', true);
            $aturan_obat = $this->input->post('aturan', true);
            $obat = [];
            $error_msgs = [];

            foreach ($id_obat as $wkwk => $kdObat) {
                $stok = $this->PeriksaModel->cekStokObat($kdObat);
                $obat_data = $this->MainModel->get_where('obat', ['kdObat' => $kdObat]);
                $obat_nama = $obat_data->nmObat;

                if ($stok == 0) {
                    $error_msgs[] = "Stok obat <span style=\"font-weight: bold; color: red;\">$obat_nama</span> habis.";
                } elseif ($jumlah_obat[$wkwk] > $stok) {
                    $error_msgs[] = "Stok obat <span style=\"font-weight: bold; color: red;\">$obat_nama</span> tidak mencukupi. Maksimal jumlah yang dapat ditambahkan adalah $stok.";
                } elseif ($jumlah_obat[$wkwk] > 0) {
                    $obat[] = [
                        'idPeriksa' => $id,
                        'kdObat' => $kdObat,
                        'jumlahObat' => $jumlah_obat[$wkwk],
                        'aturan' => $aturan_obat[$wkwk]
                    ];
                }
            }

            if (!empty($error_msgs)) {
                $error_message = implode("<br>", $error_msgs);
                $this->session->set_flashdata('pesan', "
                    <script type='text/javascript'>
                    $(document).ready(function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            html: 'Gagal menambahkan resep!<br>$error_message'
                        });
                    });
                    </script>
                ");
                // Set old input data to keep form data
                $this->session->set_flashdata('old_input', $this->input->post());
                redirect('periksa/tambahResep/' . $prId);
            } else {
                // Jika stok obat mencukupi, lanjutkan proses simpan
                foreach ($obat as $item) {
                    // Kurangi stok obat
                    $this->PeriksaModel->decreaseStokObat($item['kdObat'], $item['jumlahObat']);
                    
                    // Simpan ke stok_obat_keluar
                    $data_keluar = [
                        'kdObat' => $item['kdObat'],
                        'jumlah' => $item['jumlahObat'],
                        'idPeriksa' => $id // Simpan idPeriksa
                    ];
                    $this->MainModel->insert('stok_obat_keluar', $data_keluar);
                }
                // Simpan resep ke pr_obat
                $this->MainModel->insert_batch('pr_obat', $obat);
                msgBox('saveResep');
                redirect('periksa');
            }
        }
    }


    private function simpanStokKeluar($kdObat, $jumlah, $idPeriksa)
    {
        $data = [
            'kdObat' => $kdObat,
            'jumlah' => $jumlah,
            'idPeriksa' => $idPeriksa
        ];
        $this->db->insert('stok_obat_keluar', $data);
    }







}