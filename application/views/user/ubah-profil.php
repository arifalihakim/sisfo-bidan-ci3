		<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-fuchsia card-outline shadow-lg pb-2">
              <div class="card-body">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle bg-fuchsia" src="<?= (userdata('image') != null) ? base_url('uploads/foto_profil/' . userdata('image')) : base_url().'uploads/no_image.jpg' ?>" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?= userdata('fullName') ?></h3>
                <p class="text-muted text-center">Role : <?= (userdata('role') != 1) ? 'Bidan' : 'Super Admin' ?></p>
                <hr>
                <strong><i class="fas fa-user text-fuchsia mr-1"></i> Username</strong>
                <p class="text-muted"><?= userdata('username') ?></p>
                <hr>
                <strong><i class="fas fa-phone text-fuchsia mr-1"></i> Nomor Telepon</strong>
                <p class="text-muted"><?= userdata('noTelp') ?></p>
                <hr>
                <strong><i class="fas fa-map-marker-alt text-fuchsia mr-1"></i> Alamat</strong>
                <p class="text-muted"><?= userdata('alamat') ?></p>
              </div>
            </div>
          </div>  
          <div class="col-md-9">
            <div class="card shadow-md">
              <div class="card-header bg-fuchsia">
                  <h3 class="card-title"><?= $title; ?></h3>
                <div class="card-tools">
                  <a href="<?= site_url('dashboard') ?>" class="btn btn-tool">
                    <i class="fas fa-times text-white"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <?= form_open_multipart(); ?>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="fullName">Nama Lengkap</label>
                        <input type="text" name="fullName" id="fullName" value="<?= set_value('fullName', $dataUser->fullName); ?>" class="form-control" placeholder="Nama Lengkap..">
                        <?= form_error('fullName'); ?>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?= set_value('username', $dataUser->username); ?>" class="form-control" placeholder="Password...">
                        <?= form_error('username'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-9">
                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control"placeholder="Alamat..."><?= set_value('alamat', $dataUser->alamat); ?></textarea>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                        <label for="noTelp">Nomor Telepon</label>
                        <input type="number" name="noTelp" id="noTelp" value="<?= set_value('noTelp', $dataUser->noTelp); ?>" class="form-control" placeholder="No Telepon...">
                        <?= form_error('noTelp'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      <div class="mb-3">
                        <label class="form-label d-block">Foto</label>
                        <img id="showImage" style="width: 50px; margin-top: 5px; margin-bottom: 10px; border-radius: 5px;" class="mt-1 mb-2 rounded" src="<?= (!empty(userdata('image'))) ? base_url('uploads/foto_profil/' . userdata('image')) : base_url().'uploads/no_image.jpg' ?>" alt="profile">
                        <input type="file" name="image" class="form-control" id="image" value="<?= userdata('image')?>">
                      </div>
                    </div>
                  </div>
                  
                  <div class="text-right">
                    <button type="submit" class="btn bg-fuchsia">Simpan Perubahan</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                <?= form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#image').change(function(e){
          var reader = new FileReader();
          reader.onload = function(e){
            $('#showImage').attr('src',e.target.result);
          }
          reader.readAsDataURL(e.target.files['0']);
        });
      });
    </script>