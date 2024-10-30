<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Captcha extends CI_Controller
{
    public function generate()
    {
        $this->load->helper('captcha');

        $vals = [
            'img_path'      => './captcha/',
            'img_url'       => base_url('captcha/'),
            'font_path'     => FCPATH . 'system/fonts/texb.ttf',
            'img_width'     => '150',
            'img_height'    => 50,
            'expiration'    => 60,
            'word_length'   => 4,
            'font_size'     => 20,
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        ];

        $captcha = create_captcha($vals);

        $this->session->set_userdata('captcha', $captcha['word']);

        echo $captcha['image'];
    }
}
