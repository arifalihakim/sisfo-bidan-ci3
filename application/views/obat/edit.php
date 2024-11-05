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
                <?= form_open('', ''); ?>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="kdObat">Kode Obat</label>
                        <input readonly value="<?= set_value('kdObat', $obat->kdObat); ?>" type="text" id="kdObat" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-10">
                      <div class="form-group">
                        <label for="nmObat">Nama Obat</label>
                        <input value="<?= set_value('nmObat', $obat->nmObat)?>" type="text" name="nmObat" id="nmObat" class="form-control">
                        <?= form_error('nmObat'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="hargaObat">Harga Obat</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                          </div>
                          <input value="<?= $obat->hargaObat; ?>" type="text" name="hargaObat" id="hargaObat" class="form-control">
                        </div>
                        <?= form_error('hargaObat'); ?>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="stok">Stok Obat</label>
                        <input value="<?= set_value('stok', $obat->stok)?>" type="text" name="stok" id="stok" class="form-control" disabled>
                        <?= form_error('stok'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="ket">Keterangan</label>
                        <textarea name="ket" id="ket" rows="4" class="form-control"><?= $obat->ket ?></textarea>
                        <?= form_error('ket'); ?>
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