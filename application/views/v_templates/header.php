<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Bidan Ari | 
  <?= (userdata('role') != 1) ? 'Bidan' : 'Super Admin'; ?>
      
</title>
  
  <link rel="icon" href="<?= base_url().'assets/dist/img/ikatan_bidan.png'?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Assets css -->
  <link rel="stylesheet" href="<?= base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/dt.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <script type="text/javascript">
    setInterval(function() {
      $.ajax({
        url: '<?= site_url('user/update_activity') ?>', // Endpoint untuk update activity
        method: 'POST',
        success: function(response) {
            console.log("User activity updated");
        }
      });
    }, 30000);
  </script>
  <style type="text/css">
    .online-status .dot {
      height: 10px;
      width: 10px;
      background-color: red;
      border-radius: 50%;
      display: inline-block;
      margin-right: 5px;
      animation: blink 1s infinite;
    }

    @keyframes blink {
      0% { opacity: 1; }
      50% { opacity: 0; }
      100% { opacity: 1; }
    }
  </style>

</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed layout-footer-fixed">
  <div class="wrapper">
    <style>
      .preloader {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Mengisi layar penuh */
        background-color: #f8f9fa; /* Warna latar belakang preloader */
      }

      .preloader img {
        animation: spin 1s linear infinite; /* Animasi berputar selama 1 detik secara terus-menerus */
        margin-bottom: 20px; /* Memberi jarak antara gambar dan loading bar */
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }

      .loading-bar {
        width: 100px;
        height: 6px;
        background-color: #e0e0e0;
        position: relative;
        overflow: hidden;
        border-radius: 5px;
      }

      .loading-bar::before {
        content: '';
        position: absolute;
        width: 0;
        height: 100%;
        background-color: fuchsia; /* Warna biru untuk progress bar */
        animation: loading 2s infinite; /* Animasi untuk loading bar */
      }

      @keyframes loading {
        0% { width: 0; }
        50% { width: 100%; }
        100% { width: 0; }
      }
    </style>

    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__spin" src="<?= base_url()?>assets/dist/img/ikatan_bidan.png" alt="logo" height="60" width="60">
      <div class="loading-bar"></div>
    </div>