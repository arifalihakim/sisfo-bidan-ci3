  <aside class="main-sidebar sidebar-dark-<?= (userdata('role') != 1) ? 'fuchsia' : 'secondary' ?> elevation-2 shadow-lg">
    <a href="<?=site_url('dashboard')?>" class="brand-link">
      <img src="<?= base_url().'assets/dist/img/ikatan_bidan.png'?>" alt="Logo" class="brand-image img-circle ml-2" width="200%">
      <span class="brand-text font-weight-light">E-Bidan S.Aryanti</span>
    </a>


    <div class="sidebar">
      <div class="user-panel pt-3 pb-2 d-flex">
        <div class="image">
        <img
          src="<?= (userdata('image') != null) ? base_url('uploads/foto_profil/' . userdata('image')) : base_url().'uploads/no_image.jpg' ?>"
          class="img-circle elevation-2" alt="User Image"
        >
        </div>
        <div class="info pt-2">
          <a href="<?=site_url('user/ubahProfil') ?>" class="<?= menu_state('user', 'ubahProfil', 'badge badge-lg badge-light text-fuchsia') ?>">
            <?=userdata('fullName')?>
          </a>
        </div>

      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <?php if(is_role(1)) { ?>
            <li class="nav-header text-uppercase">Settings</li>
            <li class="nav-item">
              <a href="<?=site_url('user') ?>" class="nav-link <?= menu_state('user'); ?>">
                <i class="nav-icon fas fa-lock"></i>
                <p>
                  User Management
                </p>
              </a>
            </li>
          <?php } ?>

          <?php if(is_role(2)) { ?>
            <li class="nav-item">
              <a href="<?=site_url('dashboard') ?>" class="nav-link <?= menu_state('dashboard'); ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-header text-uppercase pt-0">
              <span>Master Data</span></li>
            <li class="nav-item">
              <a href="<?=site_url('pasien') ?>" class="nav-link <?= menu_state('pasien'); ?>">
                <i class="fas fa-female nav-icon"></i>
                <p>Data Pasien</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=site_url('obat') ?>" class="nav-link <?= menu_state('obat'); ?>">
                <i class="fas fa-capsules nav-icon"></i>
                <p>Data Obat</p>
              </a>
            </li>
            <li class="nav-header text-uppercase pt-0">
              <span>Registrasi</span></li>
            <li class="nav-item">
              <a href="<?= site_url('registrasi') ?>" class="nav-link <?= menu_state('registrasi'); ?>">
                <i class="nav-icon fas fa-user-check"></i>
                <p>Registrasi Ibu Hamil</p>
              </a>
            </li>
            <li class="nav-header text-uppercase pt-0">
              <span>Pemeriksaan</span></li>
            <li class="nav-item">
              <a href="<?= site_url('periksa') ?>" class="nav-link <?= menu_state('periksa'); ?>">
                <i class="nav-icon fas fa-notes-medical"></i>
                <p>Periksa Ibu Hamil</p>
              </a>
            </li>
            <li class="nav-header text-uppercase pt-0">
              <span>Lainnya</span></li>
            <li class="nav-item">
              <a href="<?= site_url('laporan') ?>" class="nav-link <?= menu_state('laporan'); ?>">
                <i class="nav-icon fas fa-print"></i>
                <p>Laporan</p>
              </a>
            </li>
          <?php } ?>
        </ul>
        <hr class="divider bg-secondary">
        <ul class="nav nav-pills nav-sidebar flex-column">
          <li class="nav-item d-inline-block">
            <a href="#logoutModal" data-toggle="modal" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p class="d-inline-block">
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- assets jquery harus diatas content untuk dapat menampilkan data di modal pop up -->
  <script src="<?= base_url()?>assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url()?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$title?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
              <?php if ($this->uri->segment(1) != 'dashboard') { ?>
                <li class="breadcrumb-item text-capitalize <?= $this->uri->segment(2) ? '' : 'active' ?>">
                  <?php if ($this->uri->segment(2)) { ?>
                    <a href="<?= site_url($this->uri->segment(1)) ?>"><?= $this->uri->segment(1) ?></a>
                  <?php } else { ?>
                    <?= $this->uri->segment(1) ?>
                  <?php } ?>
                </li>
              <?php } ?>
              <?php if ($this->uri->segment(2)) { ?>
                <li class="breadcrumb-item active text-capitalize">
                <?= preg_replace('/(?<!\ )[A-Z]/', ' $0', ucwords($this->uri->segment(2))) ?> 
                  <?php if ($this->uri->segment(3)) { ?>
                    <span class="text-capitalize">(<?= $this->uri->segment(3) ?>)</span>
                  <?php } ?>
                </li>
              <?php } ?>
            </ol>
          </div>
        </div>
      </div>
    </div>