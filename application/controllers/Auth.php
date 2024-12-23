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
        // $this->form_validation->set_rules('captcha', 'Captcha', 'required|trim');
        return $this->form_validation->run();
    }

    private function _check_login()
    {
        if ($this->session->has_userdata('user')) redirect('dashboard');
    }

    private function _increment_login_attempts($user = null)
    {
        $login_attempts = $this->session->userdata('login_attempts') + 1;
        $this->session->set_userdata('login_attempts', $login_attempts);

        if ($user && $login_attempts >= 3) {
            $this->MainModel->update('user', ['active' => 0], ['idUser' => $user->idUser]);
            setMsg("danger", "Password salah 3x. Akun dinonaktifkan. Hubungi Admin!");
        } else {
            setMsg("danger", "Password salah!");
        }
    }

    // private function _verify_captcha($inputCaptcha)
    // {
    //     if (strtolower($inputCaptcha) !== strtolower($this->session->userdata('captcha'))) {
    //         setMsg("danger", "Captcha tidak valid!");
    //         redirect('auth');
    //     }
    // }

    private function _process_login($user, $password)
    {
        if (!$user || !password_verify($password, $user->password)) {
            $this->_increment_login_attempts($user);
            redirect('auth');
        }

        if ($user->active != 1) {
            setMsg("danger", "Akun non-aktif. Hubungi admin.");
            redirect('auth');
        }

        $this->session->set_userdata([
            'user' => $user, 
            'is_online' => 1
        ]);
        $this->MainModel->update('user', 
            ['is_online' => 1, 'last_activity' => date('Y-m-d H:i:s')], 
            ['idUser' => $user->idUser]
        );
        $this->session->unset_userdata('login_attempts');
        msgBox('auth');
        redirect('dashboard');
    }

    public function index()
    {
        $this->_check_login();
        $data['title'] = "Login - E-Bidan S.Aryanti";

        if (!$this->_validate()) {
            $this->load->view('auth/login', $data);
            return;
        }

        // $this->_verify_captcha($this->input->post('captcha'));
        $user = $this->MainModel->get_where('user', ['username' => $this->input->post('username', true)]);
        $this->_process_login($user, $this->input->post('password', true));
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
