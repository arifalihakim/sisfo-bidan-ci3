    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card shadow-lg">
              <div class="card-header bg-fuchsia">
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
                    <input value="<?= set_value('fullName', $dataUser->fullName); ?>" type="text" name="fullName" id="fullName" class="form-control" placeholder="Nama Lengkap...">
                    <?= form_error('fullName'); ?>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat..."><?= set_value('alamat', $dataUser->alamat); ?></textarea>
                    <?= form_error('alamat'); ?>
                  </div>
                  <div class="form-group">
                    <label for="noTelp">Nomor Telepon</label>
                    <input value="<?= set_value('noTelp', $dataUser->noTelp); ?>" type="text" name="noTelp" id="noTelp" class="form-control" placeholder="Nomor Telepon...">
                    <?= form_error('noTelp'); ?>
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <div class="row">
                      <div class="col">
                        <div class="custom-control custom-radio">
                          <input <?= set_radio('role', '2', $dataUser->role == "2" ? true : false); ?> value="2" class="custom-control-input" type="radio" id="admin" name="role">
                          <label for="admin" class="custom-control-label">Bidan</label>
                        </div>
                      </div>
                      <div class="col">
                        <div class="custom-control custom-radio">
                          <input <?= set_radio('role', '1', $dataUser->role == "1" ? true : false); ?> value="1" class="custom-control-input" type="radio" id="superadmin" name="role">
                          <label for="superadmin" class="custom-control-label">Super Admin</label>
                        </div>
                      </div>
                    </div>
                    <?= form_error('role'); ?>
                  </div>
                  <div class="form-group">
                    <label for="img">Foto</label>
                    <?php if($dataUser->image != null) { ?>
                      <div class="mb-2">
                        <img id="showImage" src="<?= site_url('uploads/foto_profil/' . $dataUser->image) ?>" alt="User Image" class="img-fluid rounded-lg" style="width: 80px;">
                      </div>
                    <?php } ?>
                    <input type="file" name="image" id="img" class="form-control">
                    <small class="mt-1 mb-0">(Biarkan kosong jika tidak diganti)</small>
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