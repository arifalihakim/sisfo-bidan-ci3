    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-9">
            <div class="card shadow-lg">
              <div class="card-header bg-fuchsia">
                  <h3 class="card-title">Form <?= $title; ?></h3>
                <div class="card-tools">
                  <a href="<?= site_url('dashboard') ?>" class="btn btn-tool">
                    <i class="fas fa-times text-white"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <?= $this->session->flashdata('msg'); ?>
                  <?= form_open(); ?>
                  <div class="form-group">
                    <label for="password_lama">Password Lama</label>
                    <input type="password" name="password_lama" id="password_lama" class="form-control" placeholder="Password Lama...">
                    <?= form_error('password_lama'); ?>
                  </div>
                  <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password...">
                    <?= form_error('password'); ?>
                  </div>
                  <div class="form-group">
                    <label for="password2">Konfirmasi Password</label>
                    <input type="password" name="password2" id="password2" class="form-control" placeholder="Konfirmasi Password...">
                    <?= form_error('password2'); ?>
                  </div>
                  <div class="text-right">
                    <button type="submit" class="btn bg-fuchsia">Simpan</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                <?= form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>