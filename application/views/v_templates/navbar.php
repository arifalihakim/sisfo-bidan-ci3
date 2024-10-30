    <nav class="main-header navbar navbar-expand navbar-dark bg-<?= (userdata('role') != 1) ? 'fuchsia' : 'secondary' ?> shadow-md">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?=site_url('dashboard')?>" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <div id="jam_aktif" class="nav-link">
            <span class="text-bold">Pukul |</span> 
            <span class="text-bold" id="jam"></span> :
            <span class="text-bold" id="menit"></span> :
            <span class="text-bold" id="detik"></span>
          </div>
        </li>
      </ul>

      <ul class="navbar-nav mx-auto">
        <li class="nav-item d-none d-sm-inline-block">
          <marquee class="text-bold mt-2">Sistem Informasi Pemeriksaan Bidan Ari Berbasis Web</marquee>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle dropdown-icon" href="#" data-toggle="dropdown">
            <img src="<?= (userdata('image') != null) ? base_url('uploads/foto_profil/' . userdata('image')) : base_url().'uploads/no_image.jpg' ?>" 
            class="img-circle elevation-2 mr-2" alt="User Image" width="28px">
            <?= userdata('fullName') ?>
          </a>
          <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
            <div class="dropdown-item">
              <div class="media">
                <img src="<?= (userdata('image') != null) ? base_url('uploads/foto_profil/' . userdata('image')) : base_url().'uploads/no_image.jpg' ?>" class="mr-3 img-circle" width="30">
                <div class="media-body">
                  <h3 class="dropdown-item-title"><?= userdata('fullName') ?></h3>
                  <p class="text-sm">Role : <?= (userdata('role') != 1) ? 'Bidan' : 'Super Admin' ?></p>
                </div>
              </div>
            </div>
            <a href="<?= site_url('user/ubahProfil') ?>" class="dropdown-item">
              <i class="fas fa-fw fa-user-edit text-fuchsia"></i>
              Ubah Profil
            </a>
            <a href="<?= site_url('user/ubahPassword') ?>" class="dropdown-item">
              <i class="fas fa-fw fa-exchange-alt text-fuchsia"></i>
              Ubah Password
            </a>
            <a href="#logoutModal" class="dropdown-item" data-toggle="modal">
              <i class="fas fa-fw fa-sign-out-alt text-fuchsia"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>