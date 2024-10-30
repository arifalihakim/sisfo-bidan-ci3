<section class="content">
  <div class="container-fluid">
    <div class="card shadow-lg">

      <div class="card-header">
        <div class="row">
          <div class="col d-flex align-items-center">
            <h3 class="card-title align-self-center">Tabel <?= $title; ?></h3>
          </div>
          <div class="col-lg-7 d-flex justify-content-center align-items-center">
            <form action="<?= site_url('registrasi/filterByDate'); ?>" method="post" class="form-inline">
              <div class="form-group">
                <label for="tgl1">Data tanggal</label>
                <input type="date" name="tgl1" id="tgl1" value="<?= set_value('tgl1', isset($tgl1) ? $tgl1 : ''); ?>" class="form-control form-control-sm mx-1" required>
              </div>
              <div class="form-group">
                <label for="tgl2">sampai</label>
                <input type="date" name="tgl2" id="tgl2" value="<?= set_value('tgl2', isset($tgl2) ? $tgl2 : ''); ?>" class="form-control form-control-sm mx-1" required>
              </div>
              <button type="submit" class="btn btn-sm bg-fuchsia mx-1">Tampilkan</button>
              <a href="<?=site_url('registrasi');?>" class="btn btn-sm btn-secondary">Reset</a>
            </form>
          </div>
          <div class="col text-right action-buttons">
            <a href="<?= site_url('registrasi/add'); ?>" class="btn btn-sm bg-fuchsia">
              <i class="fas fa-plus"></i> Register
            </a>
            <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#cetakModal">
              <i class="fas fa-print"></i> Laporan
            </button>
          </div>
        </div>
      </div>

      <div class="card-body table-responsive text-nowrap">
        <table class="table table-striped table-bordered datatable">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>No.Registrasi</th>
              <th>No RM</th>
              <th>No Identitas</th>
              <th>Nama Pasien</th>
              <th>Waktu Kunjungan</th>
              <th>Status periksa</th>
              <th class="text-center aksi-column">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            if (count((array) $registrasi) > 0) { ?>
              <?php foreach ($registrasi as $row) { ?>
              <tr>
                <td><?=$no++?>.</td>
                <td><?=$row->noRegistrasi?></td>
                <td><?=$row->noRm?></td>
                <td><?=$row->noIdentitas?></td>
                <td><?=$row->nmPasien?></td>
                <td><?=indo_date($row->tglKunjungan)?></td>
                <td>
                  <?php 
                  $statusPeriksa = $this->RegistrasiModel->getPeriksaIdByRegistrasi($row->noRegistrasi);
                  if ($statusPeriksa) { ?>
                    <span class="text-success">Sudah</span>
                  <?php } else { ?>
                    <span class="text-danger">Belum</span>
                  <?php  } ?>
                </td>
                <td width="8%" class="text-center aksi-column">
                  <button class="btn btn-outline-danger btn-sm delete-btn" data-href="<?= base_url('registrasi/delete/'.$row->noRegistrasi); ?>">
                    <i class="fas fa-trash-alt"></i>
                  </button>
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

<!-- Modal -->
<div class="modal fade" id="cetakModal" tabindex="-1" role="dialog" aria-labelledby="cetakModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?= site_url('laporan/cetakRegistrasi'); ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="cetakModalLabel">Cetak Laporan Registrasi/Kunjungan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="tanggal">Rentang Tanggal Kunjungan</label>
            <input type="text" class="form-control datepicker" name="tanggal" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sm bg-fuchsia">Cetak</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.datepicker').daterangepicker({
      locale: {
        format: 'YYYY-MM-DD'
      }
    });
  });
</script>

<script>
  $(document).ready(function() {
    var currentUrl = window.location.href;

    if (currentUrl === "http://localhost/e-bidan/registrasi/filterByDate") {
      $('th.aksi-column, td.aksi-column, .action-buttons').remove();
    }
  });
</script>