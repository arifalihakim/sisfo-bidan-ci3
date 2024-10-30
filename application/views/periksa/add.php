    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
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
                <?= form_open('', '', ['idPeriksa' => $idPeriksa, 'idUser' => userdata('idUser')]); ?>
                  <div class="row">
                    <div class="col-md-12 col-lg-2">
                      <div class="form-group">
                        <label for="noRm">Pilih Pasien *</label>
                        <div class="input-group">
                          <input class="form-control" type="hidden" name="noRegistrasi" id="noRegistrasi">
                          <input class="form-control" type="text" name="noRm" id="noRm" required autofocus>
                          <div class="input-group-append">
                            <button class="btn btn-outline-info" type="button" data-toggle="modal" data-target="#modal-reg"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                      <div class="form-group">
                        <label for="nmPasien">Nama Pasien</label>
                        <input readonly type="text" id="nmPasien" name="nmPasien" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                      <div class="form-group">
                        <label for="noIdentitas">NIK</label>
                        <input readonly type="text" id="noIdentitas" name="noIdentitas" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-md-12 col-lg-2">
                      <div class="form-group">
                        <label for="tglKunjungan">Kunjungan</label>
                        <input readonly type="text" id="tglKunjungan" name="tglKunjungan" class="form-control" disabled>
                      </div>
                    </div>
                  </div>

                  <hr class="divider">

                  <div class="row">
                    <div class="col-md-6 col-lg-2">
                      <div class="form-group">
                        <label for="idPeriksa">ID Periksa</label>
                        <input readonly value="<?= set_value('idPeriksa', $idPeriksa); ?>" type="text" id="idPeriksa" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                      <div class="form-group">
                        <label for="tglPeriksa">Tanggal Periksa *</label>
                        <input value="<?= set_value('tglPeriksa', date('Y-m-d')); ?>" type="date" name="tglPeriksa" id="tglPeriksa" class="form-control" readonly>
                        <?= form_error('tglPeriksa'); ?>
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Tekanan Darah (TD) *</label>
                        <div class="form-row">
                          <div class="col-5">
                            <input value="<?= set_value('sistol'); ?>" type="text" name="sistol" class="form-control" placeholder="sist">
                            <?= form_error('sistol'); ?>
                          </div><span class="pt-2">/</span>
                          <div class="col-5">
                            <input value="<?= set_value('diastol'); ?>" type="text" name="diastol" class="form-control" placeholder="diast">
                            <?= form_error('diastol'); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="bb">Berat Badan (BB) *</label>
                        <input value="<?= set_value('bb'); ?>" type="number" step="any" name="bb" id="bb" class="form-control" placeholder="0.0 kg">
                        <?= form_error('bb'); ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="uk">Usia Kehamilan(UK)*</label>
                        <input value="<?= set_value('uk'); ?>" type="text" name="uk" id="uk" class="form-control" placeholder="00 minggu">
                        <?= form_error('uk'); ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="tfu">T.Fundus Uteri</label>
                        <input value="<?= set_value('tfu'); ?>" type="text" name="tfu" id="tfu" class="form-control" placeholder="00 cm">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="letak">Letak Janin</label>
                        <input value="<?= set_value('letak'); ?>" type="text" name="letak" id="letak" class="form-control" placeholder="Letak...">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="djj">Dt Jantung Janin</label>
                        <input value="<?= set_value('djj'); ?>" type="text" name="djj" id="djj" class="form-control" placeholder="000 &times;/mnt">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="diagnosa">Diagnosa *</label>
                        <textarea name="diagnosa" id="diagnosa" rows="2" class="form-control" placeholder="Diagnosa"><?= set_value('diagnosa'); ?></textarea>
                        <?= form_error('diagnosa'); ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Keluhan">Keluhan *</label>
                        <textarea name="keluhan" id="Keluhan" rows="2" class="form-control" placeholder="Keluhan"><?= set_value('keluhan'); ?></textarea>
                        <?= form_error('keluhan'); ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="TindakLanjut">Tindak Lanjut *</label>
                        <input value="<?= set_value('tindakLanjut'); ?>" type="text" name="tindakLanjut" id="TindakLanjut" class="form-control" placeholder="Tindak Lanjut...">
                        <?= form_error('tindakLanjut'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="imunisasi">Imunisasi</label>
                        <input value="<?= set_value('imunisasi'); ?>" type="text" name="imunisasi" id="imunisasi" class="form-control" placeholder="Imunisasi...">
                        <small>Kosongi bila tidak imunisasi</small>
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

    <div class="modal fade" id="modal-reg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Pilih Pasien</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body table-responsive">
            <table class="table table-bordered" id="datatable_simple">
              <thead>
                <tr>
                  <th>No.Registrasi</th>
                  <th>No.RM</th>
                  <th>No.Identitas</th>
                  <th>Nama Pasien</th>
                  <th>Tgl.Kunjungan</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (count((array) $registrasi) > 0) { ?>
                  <?php foreach ($registrasi as $row => $data) { ?>
                    <tr>
                      <td><?=$data->noRegistrasi?></td>
                      <td><?=$data->noRm?></td>
                      <td><?=$data->noIdentitas?></td>
                      <td><?=$data->nmPasien?></td>
                      <td><?=$data->tglKunjungan?></td>
                      <td class="text-center">
                        <?php 
                        $statusPeriksa = $this->RegistrasiModel->getPeriksaIdByRegistrasi($data->noRegistrasi);
                        if ($statusPeriksa) { ?>
                          <span class="text-success">Sudah periksa</span>
                        <?php } else { ?>
                          <button class="btn btn-xs btn-info" id="pilih"
                          data-noreg="<?=$data->noRegistrasi?>"
                          data-norm="<?=$data->noRm?>"
                          data-noidentitas="<?=$data->noIdentitas?>"
                          data-nmpasien="<?=$data->nmPasien?>"
                          data-tglkunjungan="<?=$data->tglKunjungan?>">
                          <i class="fa fa-check"> Pilih</i>
                        </button>
                        <?php  } ?>
                      </td>
                    </tr>
                  <?php } ?>
                <?php } else { ?>
                  <tr>
                    <td colspan="7" class="text-center">Belum Ada Pasien Registrasi Hari Ini<br>
                      <a class="badge badge-md badge-primary" href="<?=site_url('registrasi/add')?>"><i class="fas fa-plus text-white"></i> Regsitrasi Pasien
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function() {
        $(document).on('click', '#pilih', function() {
          var noRegistrasi = $(this).data('noreg');
          var noRm = $(this).data('norm');
          var noIdentitas = $(this).data('noidentitas');
          var nmPasien = $(this).data('nmpasien');
          var tglKunjungan = $(this).data('tglkunjungan');
          $('#noRegistrasi').val(noRegistrasi);
          $('#noRm').val(noRm);
          $('#noIdentitas').val(noIdentitas);
          $('#nmPasien').val(nmPasien);
          $('#tglKunjungan').val(tglKunjungan);
          $('#modal-reg').modal('hide');
        })
      })
    </script>

    <script>
      $(function () {
        $('#datatable_simple').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "pageLength": 10
        });
      });
    </script>