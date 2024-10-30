<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card shadow-lg">
          <div class="card-header bg-fuchsia">
            <h3 class="card-title">Form <?= $title; ?></h3>
            <div class="card-tools">
              <a onclick="history.go(-1);" class="btn btn-tool">
                <i class="fas fa-times text-white"></i>
              </a>
            </div>
          </div>
          <div class="card-body">
            <?= form_open('', '', ['kdObat' => $kdObat]); ?>   
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="kdObat">Kode Obat</label>
                    <input readonly value="<?= set_value('kdObat', $kdObat); ?>" type="text" id="kdObat" class="form-control" disabled>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label for="nmObat">Nama Obat *</label>
                    <input value="<?= set_value('nmObat'); ?>" type="text" name="nmObat" id="nmObat" class="form-control" placeholder="Nama Obat..." required>
                    <?= form_error('nmObat'); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="hrgObat">Harga Obat</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                      </div>
                      <input value="<?= set_value('hargaObat'); ?>" type="text" name="hargaObat" id="hrgObat" class="form-control" placeholder="Harga Obat" required>
                    </div>
                    <?= form_error('hargaObat'); ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="stok">Stok *</label>
                    <input value="0" type="text" name="stok" id="stok" class="form-control" placeholder="Stok Obat..." disabled>
                    <input type="hidden" name="stok" value="0"> <!-- Menyimpan nilai stok 0 secara tersembunyi -->
                    <?= form_error('stok'); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <textarea name="ket" id="ket" rows="4" class="form-control" placeholder="Keterangan Terapi.."><?= set_value('ket'); ?></textarea>
                    <?= form_error('ket'); ?>
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
