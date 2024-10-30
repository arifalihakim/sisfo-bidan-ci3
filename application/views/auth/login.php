<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url().'assets/dist/img/ikatan_bidan.png'?>">

    <link rel="stylesheet" href="<?=base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url() ?>assets/dist/css/adminlte.min.css">
    <script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>
    <script>
        function loadCaptcha() {
            $.get('<?= base_url('captcha/generate') ?>', function(data) {
                $('#captcha-image').html(data);
            });
        }

        $(document).ready(function() {
            loadCaptcha();
            setInterval(loadCaptcha, 60000); // Refresh captcha every 1 minute
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
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <?=$this->session->flashdata('msg')?>
                <p class="login-box-msg">Login untuk menggunakan aplikasi</p>
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
                <div class="form-group d-flex">
                    <div id="captcha-image"></div>
                    <input type="text" id="captcha" name="captcha" class="form-control ml-2 mt-2" placeholder="Enter Captcha">
                    <?=form_error('captcha')?>
                </div>
                <button type="submit" class="btn btn-block bg-fuchsia">Login</button>
                <?=form_close()?>
            </div>
        </div>
    </div>

    <script src="<?= base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url()?>assets/dist/js/adminlte.min.js"></script>
    <?=$this->session->flashdata('pesan')?>

</body>
</html>
