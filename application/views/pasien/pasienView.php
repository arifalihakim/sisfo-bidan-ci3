    <section class="content">
      <div class="container-fluid">
        <div class="card shadow-lg" style="background-color: #ffe9f4;">
          <div class="card-header">
            <div class="row">
              <div class="col d-flex">
                <h3 class="card-title align-self-center">
                  <?= $title; ?>
                  <span class="text-bold" style="font-size: 1.1rem; font-style: italic; color: fuchsia;" >
                    <?php if (!empty($pasienView)) { ?>
                     - <?= $pasienView[0]->nmPasien; ?> - <?= $pasienView[0]->noRm; ?>
                    <?php } ?>  
                  </span>
                </h3>
              </div>
              <div class="col text-right">
                <a href="<?= site_url('periksa/add'); ?>" class="btn btn-sm bg-fuchsia">
                  <i class="fas fa-plus"></i> Tambah Periksa
                </a>
                <a href="<?= site_url('laporan/cetakRiwayatPeriksa/').$noRm; ?>" target="_blank" class="btn btn-sm btn-default">
                  <i class="fas fa-print"></i> Cetak Riwayat
                </a>
                <a onclick="history.go(-1);" class="btn btn-sm btn-danger">Kembali
                </a>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive text-nowrap">
            <table class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th>Tgl.Periksa</th>
                  <th>TD</th>
                  <th>BB</th>
                  <th>UK</th>
                  <th>TFU</th>
                  <th>Letak</th>
                  <th>DJJ</th>
                  <th>Obat</th>
                  <th>Imunisasi</th>
                  <th>Keluhan</th>
                  <th>T.Lanjut</th>
                  <th>Diagnosa</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (count((array) $pasienView) > 0) { ?>
                  <?php foreach ($pasienView as $row) { ?>
                    <tr>
                      <td class="text-center"><?= indo_date($row->tglPeriksa) ?></td>
                      <td width="6%" class="text-right"><?= $row->sistol ?>/<?= $row->diastol ?></td>
                      <td width="6%" class="text-right"><?=!empty($row->bb) ? $row->bb." Kg" : "-"?></td>
                      <td width="6%" class="text-right"><?=!empty($row->uk) ? $row->uk." minggu" : "-"?></td>
                      <td width="6%" class="text-right"><?=!empty($row->tfu) ? $row->tfu." cm" : "-"?></td>
                      <td><?=!empty($row->letak) ? $row->letak."" : "-"?></td>
                      <td width="8%" class="text-right"><?=!empty($row->djj) ? $row->djj." &times;/mnt" : "-"?></td>
                      <td><?= $row->obat ?><br>
                      </td>
                      <td><?=!empty($row->imunisasi) ? $row->imunisasi."" : "-"?></td>
                      <td width="20%"><?= $row->diagnosa ?></td>
                      <td><?= $row->keluhan ?></td>
                      <td><?= $row->tindakLanjut ?></td>
                      <td width="12%">
                        <div class="btn-group">
                          <a target="_blank" href="<?= site_url('laporan/detailPr/').$row->idPeriksa; ?>" class="btn btn-default btn-sm">
                            <i class="fas fa-print"></i>
                          </a>
                        </div>
                        <div class="btn-group">
                          <a href="<?= site_url('periksa/detail/') . $row->idPeriksa; ?>" class="btn btn-default btn-sm">
                            <i class="fas fa-eye"></i>
                          </a>
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