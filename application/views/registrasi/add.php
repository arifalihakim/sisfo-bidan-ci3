    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="card shadow-lg">
              <div class="card-header bg-fuchsia">
                <h3 class="card-title">Form <?= $title; ?></h3>
                <div class="card-tools">
                    <a href="<?= site_url('registrasi'); ?>" class="btn btn-tool">
                        <i class="fas fa-times text-white"></i>
                    </a>
                </div>
              </div>
              <div class="card-body">
                <?= form_open('', '', ['noRegistrasi' => $noRegistrasi, 'idUser' => userdata('idUser')]); ?>
                  <div class="row">
                    <div class="col-md-12 col-lg-12">
                      <div class="form-group">
                        <label for="noRegistrasi">No.Registrasi</label>
                        <input readonly value="<?= set_value('noRegistrasi', $noRegistrasi); ?>" type="text" id="noRegistrasi" class="form-control" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-lg-12">
                      <div class="form-group">
                        <label for="noRm">Pasien *</label>
                        <select name="noRm" id="noRm" class="form-control select2">
                          <option value="" selected disabled>Pilih Pasien</option>
                          <?php foreach ($data['pasien'] as $pasien) { ?>
                            <option value="<?= $pasien->noRm ?>"><?= $pasien->nmPasien ?> - <?=$pasien->noRm?></option>
                          <?php } ?>
                        </select>
                        <?= form_error('noRm'); ?>
                      </div>
                    </div>
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