<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    private $userdata = [];

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('UserModel', 'user');

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_message('required', '%s harus diisi');
        $this->form_validation->set_message('is_unique', '%s sudah ada');
        $this->form_validation->set_message('alpha_dash', '%s tidak boleh ada spasi');
        $this->form_validation->set_message('min_length', '%s minimal 4 karakter');
        $this->form_validation->set_message('matches', '{field} tidak cocok dengan {param}');
    }

    public function index()
    {
        $idUser = userdata('idUser');

        $data['title'] = "User Management";
        $data['dataUser'] = $this->user->getUser();
     
        template_view('user/data', $data);
    }

    public function cetakBidan()
    {
        is_role(1, true);
        $data['title'] = "Data Bidan";
        $data['dataUser'] = $this->user->getUser();
        $this->load->view('user/cetak_bidan',$data);
    }

    public function toggle($userId)
    {
        is_role(1, true);
        $id = encode_php_tags($userId);
        $user = $this->MainModel->get_where('user', ['idUser' => $id]);

        $toggle = $user->active ? 0 : 1;
        $data = [
            'active' => $toggle
        ];
        
        $edit = $this->MainModel->update('user', $data, ['idUser' => $id]);
        if ($edit) {
            msgBox('edit');
        } else {
            msgBox('edit', false);
        }
        redirect('user');
    }

    private function _validasi($add = true)
    {
        is_role(1, true);
        $this->form_validation->set_rules('fullName', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($add) {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]|alpha_dash');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|alpha_dash');
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]');
        }
    }

    public function add()
    {
        is_role(1, true);
        $data['title'] = "Tambah User";

        $this->_validasi(!empty($_FILES['image']['name']));

        if ($this->form_validation->run() == false) {
            template_view('user/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
            $input['active'] = 1;

            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './uploads/foto_profil/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048;
                $config['file_name'] = 'foto-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $input['image'] = $upload_data['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    setMsg('danger', $error);
                    redirect('user/add');
                }
            }

            unset($input['password2']);

            $save = $this->MainModel->insert('user', $input);
            if ($save) {
                msgBox('save');
                redirect('user');
            } else {
                msgBox('save', false);
                redirect('user/add');
            }
        }
    }

    public function edit($userId)
    {
        is_role(1, true);
        $id = encode_php_tags($userId);
        $data['title'] = "Edit User";
        $data['dataUser'] = $this->MainModel->get_where('user', ['idUser' => $id]);

        $this->_validasi(false);
        if ($this->form_validation->run() == false) {
            template_view('user/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            
            // Cek ada gambar yang diupload/tidak
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './uploads/foto_profil/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048;
                $config['file_name'] = 'foto-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    // Hapus gambar lama jika ada
                    $dataUser = $this->MainModel->get_where('user', ['idUser' => $id]);
                    if ($dataUser->image != null) {
                        $target_file = './uploads/foto_profil/'.$dataUser->image;
                        unlink($target_file);
                    }
                    // Ubah nama gambar baru
                    $input['image'] = $upload_data['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    setMsg('danger', $error);
                    redirect('user/edit/' . $id);
                }
            } else {
                // Tidak ada gambar diupload, gunakan gambar lama
                unset($input['image']);
            }

            $edit = $this->MainModel->update('user', $input, ['idUser' => $id]);
            if ($edit) {
                msgBox('edit');
                redirect('user');
            } else {
                msgBox('edit', false);
                redirect('user/edit/' . $id);
            }
        }
    }

    public function delete($userId)
    {
        is_role(1, true);
        $id = encode_php_tags($userId);
        $del = $this->MainModel->delete('user', ['idUser' => $id]);
        if ($del) {
            msgBox('delete');
        } else {
            msgBox('delete', false);
        }
        redirect('user');
    }

    public function ubahPassword()
    {
        $data['title'] = "Ubah Password";
        $usr_pass = $this->MainModel->get_where('user', ['idUser' => userdata('idUser')])->password;

        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password', 'Password Baru', 'required|min_length[4]|alpha_dash');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() == false) {
            template_view('user/ubah-password', $data);
        } else {
            $input = $this->input->post(null, true);
            if (password_verify($input['password_lama'], $usr_pass)) {
                $newpass = password_hash($input['password'], PASSWORD_DEFAULT);
                $this->MainModel->update('user', ['password' => $newpass], ['idUser' => userdata('idUser')]);

                setMsg('success', 'Password anda berhasil diubah. Silahkan login ulang!');
                redirect('user/ubahPassword');
            } else {
                setMsg('danger', 'Password lama tidak cocok');
                redirect('user/ubahPassword');
            }
        }
    }

    public function ubahProfil()
    {
        $data['title'] = "Ubah Profil";
        $userId = $this->session->userdata('user')->idUser;

        $this->form_validation->set_rules('fullName', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('noTelp', 'No Telepon', 'required|numeric');
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_dash');

        if ($this->form_validation->run() == false) {
            $data['dataUser'] = $this->MainModel->get_where('user', ['idUser' => $userId]);
            template_view('user/ubah-profil', $data);
        } else {
            $input = $this->input->post(null, true);
            
            // Cek ada gambar yang diupload/tidak
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './uploads/foto_profil/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048;
                $config['file_name'] = 'foto-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    // Hapus gambar lama jika ada
                    $dataUser = $this->MainModel->get_where('user', ['idUser' => $userId]);
                    if ($dataUser->image != null) {
                        $target_file = './uploads/foto_profil/'.$dataUser->image;
                        unlink($target_file);
                    }
                    // Ubah nama gambar baru
                    $input['image'] = $upload_data['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    setMsg('danger', $error);
                    redirect('user/ubahProfil');
                }
            } else {
                // Tidak ada gambar diupload, gunakan gambar lama
                $input['image'] = $this->session->userdata('user')->image;
            }

            $edit = $this->MainModel->update('user', $input, ['idUser' => $userId]);
            if ($edit) {
                // Ambil data pengguna yang baru dari database
                $dataUserBaru = $this->MainModel->get_where('user', ['idUser' => $userId]);
                // Perbarui data pengguna di sesi
                $this->session->set_userdata('user', $dataUserBaru);

                msgBox('edit');
                redirect('user/ubahProfil');
            } else {
                msgBox('edit', false);
                redirect('user/ubahProfil');
            }
        }
    }

    public function update_activity()
    {
        $current_user = $this->session->userdata('user');

        if ($current_user) {
            $this->MainModel->update('user', [
                'last_activity' => date('Y-m-d H:i:s'),
                'is_online' => 1
            ], ['idUser' => $current_user->idUser]);
        }
    }

}