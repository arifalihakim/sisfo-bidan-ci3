    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <?= $this->session->flashdata('msg'); ?>
            <div class="card shadow-lg">
              <div class="card-header bg-info">
                <h3 class="card-title">Form <?= $title; ?></h3>
                <div class="card-tools">
                  <a href="<?= site_url('user') ?>" class="btn btn-tool">
                    <i class="fas fa-times text-white"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <?= form_open_multipart(); ?>
                  <div class="form-group">
                    <label for="fullName">Nama Lengkap</label>
                    <input value="<?= set_value('fullName'); ?>" type="text" name="fullName" id="fullName" class="form-control" placeholder="Nama Lengkap...">
                    <?= form_error('fullName'); ?>
                  </div>
                  <div class="form-group">
                    <label for="Alamat">Alamat</label>
                    <textarea name="alamat" id="Alamat" class="form-control" placeholder="Alamat..."><?= set_value('alamat'); ?></textarea>
                    <?= form_error('alamat'); ?>
                  </div>
                  <div class="form-group">
                    <label for="NoTelp">Nomor Telepon</label>
                    <input value="<?= set_value('noTelp'); ?>" type="text" name="noTelp" id="NoTelp" class="form-control" placeholder="Nomor Telepon...">
                    <?= form_error('noTelp'); ?>
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <div class="row">
                      <div class="col">
                        <div class="custom-control custom-radio">
                          <input <?= set_radio('role', '2'); ?> value="2" class="custom-control-input" type="radio" id="admin" name="role">
                          <label for="admin" class="custom-control-label">Bidan</label>
                        </div>
                      </div>
                      <div class="col">
                        <div class="custom-control custom-radio">
                          <input <?= set_radio('role', '1'); ?> value="1" class="custom-control-input" type="radio" id="superadmin" name="role">
                          <label for="superadmin" class="custom-control-label">Super Admin</label>
                        </div>
                      </div>
                      <?= form_error('role'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input value="<?= set_value('username'); ?>" type="text" name="username" id="username" class="form-control" placeholder="Username...">
                    <?= form_error('username'); ?>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password...">
                    <?= form_error('password'); ?>
                  </div>
                  <div class="form-group">
                    <label for="password2">Konfirmasi Password</label>
                    <input type="password" name="password2" id="password2" class="form-control" placeholder="Konfirmasi Password...">
                    <?= form_error('password2'); ?>
                  </div>
                  <div class="form-group">
                    <label for="img">Foto</label>
                    <input type="file" name="image" id="img" class="form-control">
                    <small class="mt-1 mb-0">(Biarkan kosong jika tidak ada)</small>
                  </div>
                  <div class="text-right">
                    <button type="submit" class="btn bg-info">Simpan</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                <?= form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>