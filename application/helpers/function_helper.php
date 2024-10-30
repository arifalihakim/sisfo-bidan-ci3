<?php

function template_view($view, $data = null)
{
    $ci = get_instance();
    
    $ci->load->view('v_templates/header', $data);
    $ci->load->view('v_templates/navbar');
    $ci->load->view('v_templates/sidebar');
    $ci->load->view($view);
    $ci->load->view('v_templates/footer');
}

function menu_state($page, $page2 = null, $state = 'active')
{
    $ci = get_instance();
    $uri = $ci->uri->segment(1);

    if ($page == $uri || $page2 == $uri) {
        return $state;
    }
}

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->has_userdata('user')) {
        redirect('login');
    }
}

function is_role($role = 1, $redirect = false)
{
    $ci = get_instance();
    $user = $ci->session->userdata('user');
    if ($redirect) {
        if ($user->role != $role) {
            redirect('admin/blocked');
        }
    } else {
        return $user->role == $role ? 1 : 0;
    }
}

function setMsg($type, $msg)
{
    $ci = get_instance();
    $text = "";
    $text .= "<div class='alert alert-{$type} alert-dismissible fade show' role='alert'>";
    $text .= $msg;
    $text .= "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
    $text .= "<span aria-hidden='true'>&times";
    $text .= "</span>";
    $text .= "</button>";
    $text .= "</div>";
    return $ci->session->set_flashdata('msg', $text);
}

function userdata($key = null)
{
    $ci = get_instance();
    $user = $ci->session->userdata('user');
    if ($key != null) {
        return isset($user->$key) ? $user->$key : null;
    } else {
        return $user;
    }
}

function custom_date($format, $date)
{
    return date($format, strtotime($date));
}

function indo_date($datetime, $print_day = false)
{
    $day        = [1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    $month      = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
    
    $split      = explode(' ', $datetime);
    $date       = $split[0];
    $time       = isset($split[1]) ? $split[1] : '';

    $split_date = explode('-', $date);
    $nice_date  = $split_date[2] . ' ' . $month[(int) $split_date[1]] . ' ' . $split_date[0];

    if ($print_day) {
        $num = date('N', strtotime($date));
        return $day[$num] . ', ' . $nice_date . ' ' . $time;
    }
    return $nice_date . ' ' . $time;
}


function indo_currency($value)
{
    return 'Rp. ' . number_format($value, 0, ",", ".");
}

function msgBox($msg = "save", $success = true)
{
    $pesan = "";
    switch ($msg) {
        case "save":
            $pesan = $success ? "Data berhasil disimpan!" : "Gagal menyimpan data!";
            break;
        case "edit":
            $pesan = $success ? "Data berhasil diedit!" : "Gagal mengedit data!";
            break;
        case "delete":
            $pesan = $success ? "Data berhasil dihapus!" : "Gagal menghapus data!";
            break;
        case "delBlock":
            $pesan = $success ? "Data berhasil dihapus!" : "Gagal menghapus! Sudah berelasi di tabel lain!";
            break;
        case "auth":
            $pesan = $success ? "Selamat, Anda Berhasil Login!" : "Login Gagal, Username atau Password Salah!";
            break;
        case "saveResep":
            $pesan = $success ? "Resep Berhasil Ditambahkan!" : "Gagal menambahkan resep";
            break;
        case "saveRegister":
            $pesan = $success ? "Registrasi Pasien Berhasi!" : "Gagal Menambahkan! Pasien Sudah Terdaftar Hari Ini.";
            break;
        case "isCaptcha":
            $pesan = $success ? "Captcha valid!" : "Captcha tidak valid!";
            break;
    }
    $title = $success ? "Berhasil!" : "Gagal!";
    $type = $success ? "success" : "error";
    $alert = "
        <script type='text/javascript'>
        $(document).ready(function() {
            Swal.fire(
                '{$title}',
                '{$pesan}',
                '{$type}'
            );
        });
        </script>
    ";
    $ci = get_instance();
    return $ci->session->set_flashdata('pesan', $alert);
}