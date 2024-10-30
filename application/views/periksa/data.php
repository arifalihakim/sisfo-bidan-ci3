    <section class="content">
    <div class="container-fluid">
      <div class="card shadow-lg">
        <div class="card-header">
          <div class="row">
            <div class="col d-flex align-items-center">
              <h3 class="card-title align-self-center">Tabel <?= $title; ?></h3>
            </div>
            <div class="col-lg-7 d-flex justify-content-center align-items-center">
              <form action="<?= site_url('periksa/filterByDate'); ?>" method="post" class="form-inline">
                <div class="form-group">
                  <label for="tgl1">Data tanggal</label>
                  <input type="date" name="tgl1" id="tgl1" value="<?= set_value('tgl1', isset($tgl1) ? $tgl1 : ''); ?>" class="form-control form-control-sm mx-1" required>
                </div>
                <div class="form-group">
                  <label for="tgl2">sampai</label>
                  <input type="date" name="tgl2" id="tgl2" value="<?= set_value('tgl2', isset($tgl2) ? $tgl2 : ''); ?>" class="form-control form-control-sm mx-1" required>
                </div>
                <button type="submit" class="btn btn-sm bg-fuchsia mx-1">Tampilkan</button>
                <a href="<?=site_url('periksa');?>" class="btn btn-sm btn-secondary">Reset</a>
              </form>
            </div>
            <div class="col text-right action-buttons">
              <a href="<?= site_url('periksa/add'); ?>" class="btn btn-sm bg-fuchsia">
                <i class="fas fa-plus"></i> Tambah Periksa
              </a>
              <a href="<?= site_url('laporan/periksa'); ?>" target="_blank" class="btn btn-sm btn-default">
                  <i class="fas fa-print"></i> Laporan
              </a>
            </div>
          </div>
        </div>
        <div class="card-body table-responsive text-nowrap">
          <table class="table table-striped table-bordered datatable">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th class="struk-column">Struk</th>
                <th>Tgl.Periksa</th>
                <th>Nama</th>
                <th>TD</th>
                <th>BB</th>
                <th>UK</th>
                <th>TFU</th>
                <th>DJJ</th>
                <th>Diagnosa</th>
                <!-- <th>Status Periksa</th> -->
                <th class="aksi-column">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              if (count((array) $periksa) > 0) { ?>
                <?php foreach ($periksa as $row) { ?>
                <tr>
                  <td><?=$no++?>.</td>
                  <td class="text-center struk-column">
                    <a href="<?= site_url('laporan/struk/').$row->idPeriksa; ?>" target="_blank" class="btn btn-sm btn-default"><i class="fas fa-print"></i></a>
                  </td>
                  <td class="text-center"><?=indo_date($row->tglPeriksa)?></td>
                  <td><?=$row->nmPasien?></td>
                  <td width="6%" class="text-right"><?=$row->sistol?>/<?=$row->diastol?></td>
                  <td width="6%" class="text-right"><?=!empty($row->bb) ? $row->bb." kg" : "-"?></td>
                  <td width="6%" class="text-right"><?=!empty($row->uk) ? $row->uk." minggu" : "-"?></td>
                  <td width="6%" class="text-right"><?=!empty($row->tfu) ? $row->tfu." cm" : "-"?></td>
                  <td width="8%" class="text-right"><?=!empty($row->djj) ? $row->djj." &times;/mnt" : "-"?></td>
                  <td width="20%"><?=$row->diagnosa?></td>
                  <!-- <td>
                    <?php 
                    $statusPeriksa = $this->RegistrasiModel->getPeriksaIdByRegistrasi($row->noRegistrasi);
                    if ($statusPeriksa) { ?>
                      <span class="text-success">Sudah</span>
                    <?php } else { ?>
                      <span class="text-danger">Belum</span>
                    <?php  } ?>
                  </td> -->
                  <td width="12%" class="text-center aksi-column">
                    <div class="btn-group">
                      <?php 
                      // Ambil data resep untuk periksa ini
                      $resepExist = $this->PeriksaModel->resepExistsOnPeriksa($row->idPeriksa);
                      if ($resepExist) { ?>
                        <a href="<?= site_url('periksa/detail/') . $row->idPeriksa; ?>" class="btn btn-outline-info btn-sm">
                          <i class="fas fa-eye"></i>
                        </a>
                        <a target="_blank" href="<?= site_url('laporan/detailPr/') . $row->idPeriksa; ?>" class="btn btn-outline-secondary btn-sm">
                          <i class="fas fa-print"></i>
                        </a>
                        <button class="btn btn-outline-danger btn-sm delete-btn" data-href="<?= base_url('periksa/delete/'.$row->idPeriksa); ?>">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      <?php } else { ?>
                        <a href="<?= site_url('periksa/tambahResep/') . $row->idPeriksa; ?>" class="btn btn-outline-warning btn-sm">
                          <i class="fas fa-prescription-bottle-alt"></i> Resep?
                        </a>
                        <a href="<?= site_url('periksa/detail/') . $row->idPeriksa; ?>" class="btn btn-outline-info btn-sm">
                          <i class="fas fa-eye"></i>
                        </a>
                        <a target="_blank" href="<?= site_url('laporan/detailPr/') . $row->idPeriksa; ?>" class="btn btn-outline-secondary btn-sm">
                          <i class="fas fa-print"></i>
                        </a>
                        <button class="btn btn-outline-danger btn-sm delete-btn" data-href="<?= base_url('periksa/delete/'.$row->idPeriksa); ?>">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      <?php } ?>
                    </div>
                  </td>

                </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <script>
    $(document).ready(function() {
      var currentUrl = window.location.href;

      if (currentUrl === "http://localhost/e-bidan/periksa/filterByDate") {
        $('th.aksi-column, td.aksi-column, th.struk-column, td.struk-column, .action-buttons').remove();
      }
    });
  </script>