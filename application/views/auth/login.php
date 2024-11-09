<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url().'assets/dist/img/ikatan_bidan.png'?>">
    
    <!-- Font Awesome and AdminLTE styles -->
    <link rel="stylesheet" href="<?=base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url() ?>assets/dist/css/adminlte.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(45deg, #4A90E2, #50E3C2);
            background-size: 400% 400%;
            animation: gradient-animation 8s ease infinite;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-box {
            margin-top: 0%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .login-logo a {
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }

        .login-box-msg {
            font-size: 18px;
            color: #555;
        }

        .input-group-text {
            background-color: #f0f0f0;
        }

        @keyframes glowing {
        0% { background-color: #4CAF50; }
        50% { background-color: #66BB6A; }
        100% { background-color: #4CAF50; }
        }

        .btn-block {
            background-color: #4CAF40;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            padding: 12px;
            border: none;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
            animation: glowing 1.5s infinite ease-in-out;
        }

        .btn-block:hover {
            background-color: #45a049;
        }

        .form-group input {
            border-radius: 10px;
        }

        .form-group .input-group-text {
            border-radius: 10px;
        }

        .captcha-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .captcha-container .form-control {
            width: 60%;
        }

        .captcha-container #captcha-image {
            margin-right: 10px;
        }

        .login-box p.text-sm {
            font-size: 12px;
            color: #777;
        }
    </style>
    <script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>
    <script>
        function loadCaptcha() {
            $.get('<?= base_url('captcha/generate') ?>', function(data) {
                $('#captcha-image').html(data);
            });
        }

        $(document).ready(function() {
            loadCaptcha();
            setInterval(loadCaptcha, 60000);
        });
    </script>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo text-center">
            <a href="<?=site_url('')?>" class="h4">
                <i class="d-block"><img width="30%" src="<?= base_url().'assets/dist/img/ikatan_bidan.png'?>"></i>
                <span class="text-dark">Aplikasi E-Bidan S.Aryanti</span>
                <p class="text-sm text-muted">
                    Sistem Pemeriksaan Ibu Hamil
                </p>
            </a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <?=$this->session->flashdata('msg')?>
                <?=form_open()?>
                <div class="form-group">
                    <div class="input-group">
                        <input autofocus onfocus="this.select()" type="text" id="username" name="username" class="form-control" value="<?=set_value('username')?>" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <?=form_error('username')?>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?=form_error('password')?>
                </div>
                <!-- Captcha -->
                <div class="form-group captcha-container">
                    <div id="captcha-image"></div>
                    <input type="text" id="captcha" name="captcha" class="form-control mt-2" placeholder="Enter Captcha">
                    <?=form_error('captcha')?>
                </div>
                <button type="submit" class="btn btn-block">Login</button>
                <?=form_close()?>
            </div>
        </div>
    </div>

    <script src="<?= base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url()?>assets/dist/js/adminlte.min.js"></script>
    <?=$this->session->flashdata('pesan')?>
</body>
</html>
