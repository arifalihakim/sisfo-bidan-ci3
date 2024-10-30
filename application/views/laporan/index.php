  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="row">

        <div class="col-md-6">
          <div class="card shadow-lg">
            <div class="card-header collapsed-card bg-fuchsia">
              <div class="d-flex justify-content-between">
                <div class="text-left">
                  <h3 class="card-title">Laporan Data Pemeriksaan Filter</h3>
                </div>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?= form_open(); ?>
              <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <div class="input-group">
                  <input value="<?= set_value('tanggal', date('Y-m-d')); ?>" type="text" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
                  </div>
                </div>
                <?= form_error('tanggal'); ?>
              </div>
              <div class="text-right">
                <button type="submit" target="_blank" class="btn bg-fuchsia">Cetak</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </div>
              <?= form_close(); ?>
            </div>
          </div>
        </div>

        <!-- <div class="col-md-4">
          <div class="card shadow-md">
            <div class="card-header collapsed-card bg-fuchsia">
              <div class="d-flex justify-content-between">
                <div class="text-left">
                  <h3 class="card-title">Laporan Data Pemeriksaan Non Filter</h3>
                </div>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="card-body text-center">
              <a href="<?= site_url('laporan/periksa'); ?>" target="_blank" class="btn btn-md btn-secondary">
                <i class="fas fa-print"></i> Cetak PDF
              </a>
            </div>
          </div>
        </div> -->

      </div>

      <div class="row">

        <div class="col-md-4">
          <div class="card shadow-md">
            <div class="card-header collapsed-card bg-fuchsia">
              <div class="d-flex justify-content-between">
                <div class="text-left">
                  <h3 class="card-title">Laporan Data Pasien</h3>
                </div>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="card-body text-center">
              <a href="<?= site_url('laporan/pasien'); ?>" target="_blank" class="btn btn-md btn-secondary mx-1">
                <i class="fas fa-print"></i> Cetak PDF
              </a>
              <button class="btn btn-md btn-secondary" data-toggle="modal" data-target="#cetakModalPasien">
                <i class="fas fa-calendar"></i> Pilih Tanggal
              </button>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-md">
            <div class="card-header collapsed-card bg-fuchsia">
              <div class="d-flex justify-content-between">
                <div class="text-left">
                  <h3 class="card-title">Laporan Data Obat</h3>
                </div>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="card-body text-center">
              <a href="<?= site_url('laporan/obat'); ?>" target="_blank" class="btn btn-md btn-secondary">
                <i class="fas fa-print"></i> Cetak PDF
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-md">
            <div class="card-header collapsed-card bg-fuchsia">
              <div class="d-flex justify-content-between">
                <div class="text-left">
                  <h3 class="card-title">Laporan Data Kunjungan</h3>
                </div>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="card-body text-center">
              <button class="btn btn-md btn-secondary" data-toggle="modal" data-target="#cetakModal">
                <i class="fas fa-calendar"></i> Pilih Tanggal
              </button>
            </div>
          </div>
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

<!-- Modal -->
<div class="modal fade" id="cetakModalPasien" tabindex="-1" role="dialog" aria-labelledby="cetakModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?= site_url('laporan/pasienFilter'); ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="cetakModalLabel">Cetak Laporan Data Pasien</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="tanggal">Rentang Tanggal Daftar Pasien Terdaftar</label>
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