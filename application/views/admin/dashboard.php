    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 col-sm-12 col-lg-4">  
            <div class="info-box shadow-lg">
              <span class="info-box-icon bg-info"><i class="fas fa-female"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Pasien Ibu Hamil</span>
                <span class="info-box-number"><?= $jumlah['pasien'] ?></span>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-12 col-lg-4">
            <div class="info-box shadow-lg">
              <span class="info-box-icon bg-warning"><i class="fas fa-capsules"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Obat</span>
                <span class="info-box-number"><?= $jumlah['obat']?></span>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-12 col-lg-4">
            <div class="info-box shadow-lg">
              <span class="info-box-icon bg-danger"><i class="fas fa-notes-medical"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Pemeriksaan</span>
                <span class="info-box-number"><?= $jumlah['periksa'] ?></span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-sm-12 col-lg-4">
            <div class="info-box shadow-lg">
              <span class="info-box-icon bg-primary"><i class="fas fa-list"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Registrasi/Kunjungan Pasien</span>
                <span class="info-box-number"><?= $jumlah['registrasi'] ?></span>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-12 col-lg-4">
            <div class="info-box shadow-lg">
              <span class="info-box-icon bg-light"><i class="fas fa-user-check"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Registrasi Hari Ini</span>
                <?php if ($jumlah_registrasi_hari_ini == 0) { ?>
                  <span class="text-danger text-sm">Belum ada registrasi</span>
                <?php } else { ?>
                  <span class="info-box-number"><?= $jumlah_registrasi_hari_ini ?></span>
                <?php } ?>
              </div>
              <span class="mx-auto"><a href="<?=site_url('registrasi/add')?>" class="btn btn-xs btn-outline-light"><i class="fas fa-plus"></i></a></span>
            </div>
          </div>
          <div class="col-md-4 col-sm-12 col-lg-4">
            <div class="info-box shadow-lg">
              <span class="info-box-icon bg-success"><i class="fas fa-user-md"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pemeriksaan Hari Ini</span>
                <?php if ($jumlah_periksa_hari_ini == 0) { ?>
                  <span class="text-danger text-sm">Belum ada pemeriksaan</span>
                <?php } else { ?>
                  <span class="info-box-number"><?= $jumlah_periksa_hari_ini ?></span>
                <?php } ?>
              </div>
              <span class="mx-auto"><a href="<?=site_url('periksa/add')?>" class="btn btn-xs btn-outline-light"><i class="fas fa-plus"></i></a></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-lg-7">
            <div class="card shadow-lg">
              <div class="card-header collapsed-card">
                <div class="d-flex justify-content-between">
                  <div class="text-left">
                    <h3 class="card-title">Data Kunjungan</h3>
                    <span class="text-muted small d-block"><?= date('Y') ?></span>
                  </div>
                  <a class="btn btn-default btn-sm align-self-center" href="<?= base_url('laporan') ?>"><i class="fas fa-print"></i> Cetak Laporan</a>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="periksa-chart" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-lg-5">
            <div class="card shadow-md">
              <div class="card-header collapsed-card">
                <div class="d-flex justify-content-between">
                  <div class="text-left">
                    <h3 class="card-title">Pasien periksa Hari ini 
                      <span style="font-style: italic;"><?= date('d-m-Y') ?></span>
                    </h3>
                  </div>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                  </div>
                </div>
              </div>
              <div class="card-body table-responsive text-nowrap">
                <table class="table table-striped table-bordered" id="datatable_simple">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Pasien</th>
                      <th>Diagnosa</th>
                      <th>Lihat</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 1;
                  if (count((array) $periksa) > 0) { ?>
                    <?php foreach ($periksa as $row => $data) { ?>
                    <tr>
                      <td><?=$no++?>.</td>
                      <td><?=$data->nmPasien?></td>
                      <td width="20%"><?=$data->diagnosa?></td>
                      <td width="12%">
                        <a id="show_dtl"
                          class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#modal-detail"
                          data-idperiksa="<?=$data->idPeriksa?>"
                          data-norm="<?=$data->noRm?>"
                          data-noidentitas="<?=$data->noIdentitas?>"
                          data-nmpasien="<?=$data->nmPasien?>"
                          data-bb="<?=$data->bb?>"
                          data-uk="<?=$data->uk?>"
                          data-sistol="<?=$data->sistol?>"
                          data-diastol="<?=$data->diastol?>"
                          data-keluhan="<?=$data->keluhan?>"
                          data-tindaklanjut="<?=$data->tindakLanjut?>"
                          data-tglperiksa="<?=indo_date($data->tglPeriksa)?>"
                          data-diagnosa="<?=$data->diagnosa?>"
                        ><i class="fas fa-eye"></i></a>
                          </a>
                      </td>
                    </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="4" class="text-center">Belum ada pemeriksaan hari ini</td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="modal fade" id="modal-detail">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-info pb-2 pt-2">
            <h4 class="modal-title">Detail Periksa Pasien</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body table-responsive">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th width="35%">ID Periksa</th>
                  <td><span id="idPeriksa" class="text-bold"></span></td>
                </tr>
                <tr>
                  <th width="35%">No. RM</th>
                  <td><span id="noRm" class="text-bold"></span></td>
                </tr>
                <tr>
                  <th>No Identitas</th>
                  <td><span id="noIdentitas"></span></td>
                </tr>
                <tr>
                  <th>Nama Pasien</th>
                  <td><span id="nmPasien"></span></td>
                </tr>
                <tr>
                  <th>Berat Badan</th>
                  <td><span id="bb"></span></td>
                </tr>
                <tr>
                  <th>Usia Kehamilan</th>
                  <td><span id="uk"></span></td>
                </tr>
                <tr>
                  <th>Tekanan Darah</th>
                  <td><span id="sistol"></span> / <span id="diastol"></span></td>
                </tr>
                <!-- <tr>
                  <th>Buku KIA</th>
                  <td><span id="kia"></span></td>
                </tr> -->
                <tr>
                  <th>Keluhan</th>
                  <td><span id="keluhan"></span></td>
                </tr>
                <tr>
                  <th>Tindak Lanjut</th>
                  <td><span id="tindakLanjut"></span></td>
                </tr>
                <tr>
                  <th>Tgl Periksa</th>
                  <td><span id="tglPeriksa"></span></td>
                </tr>
                <tr>
                  <th>Diagnosa</th>
                  <td><span id="diagnosa"></span></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function() {
        $(document).on('click', '#show_dtl', function() {
          var data = $(this).data();
          $('#idPeriksa').text(data.idperiksa);
          $('#noRm').text(data.norm);
          $('#noIdentitas').text(data.noidentitas);
          $('#nmPasien').text(data.nmpasien);
          $('#bb').text(data.bb);
          $('#uk').text(data.uk);
          $('#sistol').text(data.sistol);
          $('#diastol').text(data.diastol);
          // $('#kia').text(data.kia);
          $('#keluhan').text(data.keluhan);
          $('#tindakLanjut').text(data.tindaklanjut);
          $('#tglPeriksa').text(data.tglperiksa);
          $('#diagnosa').text(data.diagnosa);
        });
      });
    </script>

    <script>
      $(function () {
        $('#datatable_simple').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "pageLength": 4
        });
      });
    </script>