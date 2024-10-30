<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_message('required', 'Kolom <b><i>%s</i></b> tidak boleh kosong');
    }

    private function _validate()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required|trim');
    }

    private function _check_login()
    {
        if ($this->session->has_userdata('user')) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $this->_check_login();
        $data['title'] = "Login - E-Bidan S.Aryanti";
        $this->_validate();

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login', $data);
            return;
        }

        // Validasi Captcha
        $inputCaptcha = strtolower($this->input->post('captcha'));
        $sessionCaptcha = strtolower($this->session->userdata('captcha'));
        if ($inputCaptcha !== $sessionCaptcha) {
            setMsg("danger", "Captcha tidak Valid!");
            redirect('auth');
        }

        // Proses login
        $input = $this->input->post(null, true);
        $username = $input['username'];
        $password = $input['password'];
        $where = ['username' => $username];
        $user = $this->MainModel->get_where('user', $where);

        if (!$user) {
            $this->_increment_login_attempts();
            setMsg("danger", "Username tidak terdaftar");
            redirect('auth');
        }

        if (!password_verify($password, $user->password)) {
            $this->_increment_login_attempts($user);
            redirect('auth');
        }

        if ($user->active != 1) {
            setMsg("danger", "Akun anda non-aktif. Silahkan hubungi admin.");
            redirect('auth');
        }

        // Set session dan update status online
        $session = [
            'user' => $user,
            'is_online' => 1
        ];
        $this->session->set_userdata($session);
        
        // Update status online dan last_activity
        $this->MainModel->update('user', [
            'is_online' => 1,
            'last_activity' => date('Y-m-d H:i:s')
        ], ['idUser' => $user->idUser]);

        $this->session->unset_userdata('login_attempts');
        msgBox('auth');
        redirect('dashboard');
    }


    private function _increment_login_attempts($user = null)
    {
        $login_attempts = $this->session->userdata('login_attempts');
        $login_attempts = $login_attempts ? $login_attempts + 1 : 1;
        $this->session->set_userdata('login_attempts', $login_attempts);

        if ($user && $login_attempts >= 3) {
            $this->MainModel->update('user', ['active' => 0], ['idUser' => $user->idUser]);
            setMsg("danger", "Kamu memasukkan password salah sebanyak 3x. Akunmu di non aktifkan! Hubungi Admin!");
        } else {
            setMsg("danger", "Password salah!");
        }
    }

    public function logout()
    {
        $current_user = $this->session->userdata('user');

        // Update status offline dan waktu logout
        $this->MainModel->update('user', [
            'is_online' => 0,
            'last_activity' => date('Y-m-d H:i:s')
        ], ['idUser' => $current_user->idUser]);

        // Hapus session
        $this->session->set_userdata('is_online', false);
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('login_attempts');
        
        setMsg("success", "Berhasil logout!");
        redirect('login');
    }
}
