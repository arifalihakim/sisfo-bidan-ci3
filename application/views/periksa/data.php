<section class="content">
  <div class="container-fluid">
    <div class="card shadow-lg">
      <div class="card-header">
        <div class="row">
          <div class="col d-flex align-items-center">
            <h3 class="card-title">Tabel <?= $title; ?></h3>
          </div>
          <div class="col-lg-7 d-flex justify-content-center">
            <form action="<?= site_url('periksa/filterByDate'); ?>" method="post" class="form-inline">
              <?php 
                $fields = [
                  ['tgl1', 'Data tanggal'], 
                  ['tgl2', 'sampai']
                ];
                foreach ($fields as $field) {
                  echo "<div class='form-group'>
                          <label for='{$field[0]}'>{$field[1]}</label>
                          <input type='date' name='{$field[0]}' id='{$field[0]}' value='" . set_value($field[0], $$field[0] ?? '') . "' class='form-control form-control-sm mx-1' required>
                        </div>";
                }
              ?>
              <button type="submit" class="btn btn-sm bg-fuchsia mx-1">Tampilkan</button>
              <a href="<?= site_url('periksa'); ?>" class="btn btn-sm btn-secondary">Reset</a>
            </form>
          </div>
          <div class="col text-right action-buttons">
            <a href="<?= site_url('periksa/add'); ?>" class="btn btn-sm bg-fuchsia"><i class="fas fa-plus"></i> Tambah Periksa</a>
            <a href="<?= site_url('laporan/periksa'); ?>" target="_blank" class="btn btn-sm btn-default"><i class="fas fa-print"></i> Laporan</a>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive text-nowrap">
        <table class="table table-striped table-bordered datatable">
          <thead>
            <tr>
              <th>#</th><th class="struk-column">Struk</th><th>Tgl.Periksa</th><th>Nama</th>
              <th>TD</th><th>BB</th><th>UK</th><th>TFU</th><th>DJJ</th><th>Diagnosa</th>
              <th class="aksi-column">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($periksa ?? [] as $row) { ?>
            <tr>
              <td><?= $no++; ?>.</td>
              <td class="text-center struk-column">
                <a href="<?= site_url('laporan/struk/') . $row->idPeriksa; ?>" target="_blank" class="btn btn-sm btn-default"><i class="fas fa-print"></i></a>
              </td>
              <td class="text-center"><?= indo_date($row->tglPeriksa) ?></td>
              <td><?= $row->nmPasien ?></td>
              <td class="text-right"><?= $row->sistol ?>/<?= $row->diastol ?></td>
              <td class="text-right"><?= $row->bb ? $row->bb . ' kg' : '-' ?></td>
              <td class="text-right"><?= $row->uk ? $row->uk . ' minggu' : '-' ?></td>
              <td class="text-right"><?= $row->tfu ? $row->tfu . ' cm' : '-' ?></td>
              <td class="text-right"><?= $row->djj ? $row->djj . ' &times;/mnt' : '-' ?></td>
              <td><?= $row->diagnosa ?></td>
              <td class="text-center aksi-column">
                <div class="btn-group">
                  <?php $resepExist = $this->PeriksaModel->resepExistsOnPeriksa($row->idPeriksa); ?>
                  <a href="<?= site_url($resepExist ? 'periksa/detail/' : 'periksa/tambahResep/') . $row->idPeriksa; ?>" class="btn btn-outline-<?= $resepExist ? 'info' : 'warning' ?> btn-sm">
                    <i class="fas <?= $resepExist ? 'fa-eye' : 'fa-prescription-bottle-alt' ?>"></i> <?= $resepExist ? '' : 'Resep?' ?>
                  </a>
                  <a target="_blank" href="<?= site_url('laporan/detailPr/') . $row->idPeriksa; ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-print"></i></a>
                  <button class="btn btn-outline-danger btn-sm delete-btn" data-href="<?= base_url('periksa/delete/'.$row->idPeriksa); ?>"><i class="fas fa-trash-alt"></i></button>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    if (window.location.href === "http://localhost/e-bidan/periksa/filterByDate") {
      $('.aksi-column, .struk-column, .action-buttons').remove();
    }
  });
</script>

