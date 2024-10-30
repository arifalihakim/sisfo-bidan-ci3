     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card shadow-lg">
              <div class="card-header bg-fuchsia">
                <h3 class="card-title text-white">Form <?= $title; ?></h3>
                <div class="card-tools">
                    <a onclick="history.go(-1);" class="btn btn-tool">
                        <i class="fas fa-times text-white"></i>
                    </a>
                </div>
              </div>
              <div class="card-body">
                <?= form_open('', '', ['idUser' => userdata('idUser')]); ?>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="idPeriksa">ID Periksa</label>
                        <input readonly value="<?= set_value('idPeriksa', $periksa->idPeriksa); ?>" type="text" id="idPeriksa" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="tglPeriksa">Tanggal Periksa *</label>
                        <input value="<?= set_value('tglPeriksa', $periksa->tglPeriksa); ?>" type="text" name="tglPeriksa" id="tglPeriksa" class="form-control gijgo">
                        <?= form_error('tglPeriksa'); ?>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <label for="noRm">Pasien *</label>
                        <select name="noRm" id="noRm" class="form-control select2">
                          <?php foreach ($data['pasien'] as $pasien) { ?>
                              <option <?= $periksa->noRm == $pasien->noRm ? 'selected' : ''; ?> value="<?= $pasien->noRm ?>"><?= $pasien->nmPasien ?> - <?= $pasien->noRm ?></option>
                          <?php } ?>
                        </select>
                        <?= form_error('noRm'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Tekanan Darah (TD) *</label>
                        <div class="form-row">
                          <div class="col-5">
                            <input value="<?= set_value('sistol', $periksa->sistol); ?>" type="text" name="sistol" class="form-control">
                            <?= form_error('sistol'); ?>
                          </div><span class="pt-2">/</span>
                          <div class="col-5">
                            <input value="<?= set_value('diastol', $periksa->diastol); ?>" type="text" name="diastol" class="form-control">
                            <?= form_error('diastol'); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="bb">Berat Badan (BB) *</label>
                        <input value="<?= set_value('bb', $periksa->bb); ?>" type="number" step="any" name="bb" id="bb" class="form-control">
                        <?= form_error('bb'); ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="uk">Usia Kehamilan(UK)*</label>
                        <input value="<?= set_value('uk', $periksa->uk); ?>" type="text" name="uk" id="uk" class="form-control">
                        <?= form_error('uk'); ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="tfu">T.Fundus Uteri</label>
                        <input value="<?= set_value('tfu', $periksa->tfu); ?>" type="text" name="tfu" id="tfu" class="form-control">
                        <?= form_error('tfu'); ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="letak">Letak Janin</label>
                        <input value="<?= set_value('letak', $periksa->letak); ?>" type="text" name="letak" id="letak" class="form-control">
                        <?= form_error('letak'); ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="djj">Dt Jantung Janin</label>
                        <input value="<?= set_value('djj', $periksa->djj); ?>" type="text" name="djj" id="djj" class="form-control">
                        <?= form_error('djj'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Buku KIA</label>
                        <div class="row">
                        	<div class="col">
                        		<div class="custom-control custom-radio">
                        			<input <?= set_radio('kia', 'Baru', $periksa->kia == "Baru" ? true : false); ?> value="Baru" class="custom-control-input" type="radio" id="baru" name="kia">
                        			<label for="baru" class="custom-control-label">Baru</label>
                        		</div>
                          </div>
                          <div class="col">
                          	<div class="custom-control custom-radio">
                          		<input <?= set_radio('kia', 'Punya', $periksa->kia == "Punya" ? true : false); ?> value="Punya" class="custom-control-input" type="radio" id="punya" name="kia">
                          		<label for="punya" class="custom-control-label">Punya</label>
                          	</div>
                          </div>
                        </div>
                        <?= form_error('kia'); ?>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="diagnosa">Diagnosa *</label>
                        <textarea name="diagnosa" id="diagnosa" rows="2" class="form-control"><?= set_value('diagnosa', $periksa->diagnosa); ?></textarea>
                      <?= form_error('diagnosa'); ?>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="kdObat">Obat *</label>
                        <select multiple name="kdObat[]" id="kdObat" class="form-control select2">
                          <?php foreach ($data['obat'] as $obat) { ?>
                            <option <?= in_array($obat->kdObat, $pr_obat) ? 'selected' : ''; ?> value="<?= $obat->kdObat ?>"><?= $obat->nmObat; ?></option>
                          <?php } ?>
                        </select>
                        <?= form_error('kdObat'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="imunisasi">Imunisasi</label>
                        <input value="<?= set_value('imunisasi', $periksa->imunisasi); ?>" type="text" name="imunisasi" id="imunisasi" class="form-control" placeholder="Imunisasi...">
                        <small>Biarkan bila tidak diganti</small>
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