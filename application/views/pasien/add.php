    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-md-8">
            <div class="card shadow-lg">
              <div class="card-header bg-info">
                <h3 class="card-title">Form <?= $title; ?></h3>
                <div class="card-tools">
                    <a onclick="history.go(-1);" class="btn btn-tool">
                        <i class="fas fa-times text-white"></i>
                    </a>
                </div>
              </div>
              <div class="card-body">
                <?= form_open('', '', ['noRm' => $noRm]); ?>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="noRm">No.RM</label>
                        <input readonly value="<?= set_value('noRm', $noRm); ?>" type="text" id="noRm" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="noIdentitas">No.Identitas *</label>
                        <input value="<?= set_value('noIdentitas'); ?>" type="number" name="noIdentitas" id="noIdentitas" class="form-control" placeholder="No.KTP / KK...">
                        <?= form_error('noIdentitas'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nmSuami">Nama Suami *</label>
                        <input value="<?= set_value('nmSuami'); ?>" type="text" name="nmSuami" id="nmSuami" class="form-control" placeholder="Nama Lengkap...">
                        <?= form_error('nmSuami'); ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nmPasien">Nama Pasien *</label>
                        <input value="<?= set_value('nmPasien'); ?>" type="text" name="nmPasien" id="nmPasien" class="form-control" placeholder="Nama Lengkap...">
                        <?= form_error('nmPasien'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="noTelp">No.Telp *</label>
                        <input value="<?= set_value('noTelp'); ?>" type="number" name="noTelp" id="noTelp" class="form-control" placeholder="No.Telp...">
                        <?= form_error('noTelp'); ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="tglLahir">Tanggal Lahir *</label>
                        <input value="<?= set_value('tglLahir') ?>" type="date" name="tglLahir" id="tglLahir" class="form-control">
                        <?= form_error('tglLahir'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="alamat">Alamat *</label>
                        <textarea name="alamat" id="alamat" rows="4" class="form-control" placeholder="Alamat"><?= set_value('alamat'); ?></textarea>
                        <?= form_error('alamat'); ?>
                      </div>
                    </div>
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

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('tglLahir').setAttribute('max', today);
      });
    </script>