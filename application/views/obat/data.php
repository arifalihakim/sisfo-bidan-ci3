    <section class="content">
      <div class="container-fluid">
        <div class="card shadow-lg">
          <div class="card-header">
            <div class="row">
              <div class="col d-flex">
                <h3 class="card-title align-self-center">Tabel <?= $title; ?></h3>
              </div>
              <div class="col text-right">
                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#stokModal">
                  <i class="fas fa-eye"></i> Data Stok Obat
                </button>
                <a href="<?= site_url('obat/add'); ?>" class="btn btn-sm bg-fuchsia">
                  <i class="fas fa-plus"></i> Tambah Data
                </a>
                <a href="<?= site_url('laporan/obat'); ?>" target="_blank" class="btn btn-sm btn-default">
                  <i class="fas fa-print"></i> Laporan
                </a>
            </div>
            </div>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th style="width: 10px">Kode</th>
                  <th>Nama Obat</th>
                  <th>Harga</th>
                  <th>Stok</th>
                  <th>Keterangan</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
              if (count((array) $obat) > 0) { ?>
                <?php foreach ($obat as $row) { ?>
                <tr>
                  <td><?=$row->kdObat?></td>
                  <td width="20%"><?=$row->nmObat?></td>
                  <td width="10%" class="text-right"><?=indo_currency($row->hargaObat)?></td>
                  <td class="text-center">
                    <?= $row->stok ?>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" 
                            data-target="#modalTambahStok" 
                            data-kdobat="<?= $row->kdObat ?>" data-stok="<?= $row->stok ?>">Tambah
                    </button>
                  </td>
                  <td><?=$row->ket?></td>
                  <td width="10%" class="text-center">
                    <div class="btn-group">
                      <a href="<?= base_url('obat/edit/'.$row->kdObat); ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-edit"></i>
                      </a>
                      <button class="btn btn-outline-danger btn-sm delete-btn" data-href="<?= base_url('obat/delete/'.$row->kdObat); ?>">
                        <i class="fas fa-trash-alt"></i>
                      </button>
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

    <!-- Modal untuk menambah stok -->
<div class="modal fade" id="modalTambahStok" tabindex="-1" role="dialog" aria-labelledby="modalTambahStokLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahStokLabel">Tambah Stok Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formTambahStok" action="<?= site_url('obat/tambahStok') ?>" method="post">
          <div class="form-group">
            <label for="kdObat">Kode Obat</label>
            <input type="text" class="form-control" id="kdObat" name="kdObat" readonly>
          </div>
          <div class="form-group">
            <label for="jumlah">Jumlah Stok</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required min="1">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Tambah Stok</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="stokModal" tabindex="-1" role="dialog" aria-labelledby="stokModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stokModalLabel">Data Stok Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="stokTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="stokMasuk-tab" data-toggle="tab" href="#stokMasuk" role="tab" aria-controls="stokMasuk" aria-selected="true">Stok Obat Masuk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="stokKeluar-tab" data-toggle="tab" href="#stokKeluar" role="tab" aria-controls="stokKeluar" aria-selected="false">Stok Obat Keluar</a>
          </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="stokTabContent">
          <!-- Stok Obat Masuk Tab -->
          <div class="tab-pane fade show active" id="stokMasuk" role="tabpanel" aria-labelledby="stokMasuk-tab">
            <!-- Month Filter for Stok Obat Masuk -->
            <div class="d-flex align-items-center mt-3 mb-2">
              <label for="filterMasukMonth">Filter Bulan : </label>
              <input type="month" id="filterMasukMonth" class="form-control" style="width: 200px;">
              <button id="filterMasukButton" class="btn btn-primary">Cari</button>
            </div>
            
            <!-- Table for Stok Obat Masuk -->
            <div class="table-responsive mt-3">
              <table class="table table-bordered" id="datatable_stokMasuk">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Kode Obat</th>
                    <th>Jumlah Masuk</th>
                    <th>Tanggal Masuk</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count((array) $stok_obat_masuk) > 0) { ?>
                    <?php foreach ($stok_obat_masuk as $row) { ?>
                      <tr data-date="<?= date('Y-m', strtotime($row->tanggal)); ?>">
                        <td><?= $row->id; ?></td>
                        <td><?= $row->kdObat; ?></td>
                        <td><?= $row->jumlah; ?></td>
                        <td><?= $row->tanggal; ?></td>
                      </tr>
                    <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Stok Obat Keluar Tab -->
          <div class="tab-pane fade" id="stokKeluar" role="tabpanel" aria-labelledby="stokKeluar-tab">
            <!-- Month Filter for Stok Obat Keluar -->
            <div class="d-flex align-items-center mt-3 mb-2">
              <label for="filterKeluarMonth">Filter Bulan :</label>
              <input type="month" id="filterKeluarMonth" class="form-control" style="width: 200px;">
              <button id="filterKeluarButton" class="btn btn-primary">Cari</button>
            </div>
            
            <!-- Table for Stok Obat Keluar -->
            <div class="table-responsive mt-3">
              <table class="table table-bordered" id="datatable_stokKeluar">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Kode Obat</th>
                    <th>Jumlah Keluar</th>
                    <th>ID Periksa</th>
                    <th>Tanggal Keluar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count((array) $stok_obat_keluar) > 0) { ?>
                    <?php foreach ($stok_obat_keluar as $row) { ?>
                    <tr data-date="<?= date('Y-m', strtotime($row->tanggal)); ?>">
                      <td><?= $row->id; ?></td>
                      <td><?= $row->kdObat; ?></td>
                      <td><?= $row->jumlah; ?></td>
                      <td><?= $row->idPeriksa; ?></td>
                      <td><?= $row->tanggal; ?></td>
                    </tr>
                    <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script>
  // Menangani data yang ditampilkan di modal saat dibuka
  $('#modalTambahStok').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var kdObat = button.data('kdobat');
    var stok = button.data('stok');

    var modal = $(this);
    modal.find('#kdObat').val(kdObat);
    modal.find('#jumlah').val(1);
  });

  // Menangani submit form tambah stok dengan SweetAlert
  $('#formTambahStok').on('submit', function(event) {
    event.preventDefault(); // Mencegah submit default

    var kdObat = $('#kdObat').val();
    var jumlah = $('#jumlah').val();

    // Menampilkan SweetAlert konfirmasi
    Swal.fire({
      title: 'Konfirmasi',
      text: 'Apakah Anda yakin ingin menambah stok untuk obat dengan ID ' + kdObat + ' sebanyak ' + jumlah + '?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // Jika ya, kirim form
        this.submit(); // Submit form secara manual
      }
    });
  });
</script>

<script>
  $(document).ready(function () {
  // Initialize the DataTables
  var tableMasuk = $('#datatable_stokMasuk').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "pageLength": 10
  });

  var tableKeluar = $('#datatable_stokKeluar').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "pageLength": 10
  });

  // Filter function for Stok Obat Masuk by month
  $('#filterMasukButton').on('click', function() {
    var selectedMonth = $('#filterMasukMonth').val();
    
    // If no month selected, reset the filter
    if (!selectedMonth) {
      tableMasuk.search('').draw();
      return;
    }

    // Format the selected month to match the YYYY-MM format
    tableMasuk.rows().every(function() {
      var rowDate = $(this.node()).find('td').eq(3).text().trim(); // Date column
      var rowMonth = rowDate.slice(0, 7); // Extract YYYY-MM format
      var match = rowMonth === selectedMonth;
      $(this.node()).toggle(match);
    });
  });

  // Filter function for Stok Obat Keluar by month
  $('#filterKeluarButton').on('click', function() {
    var selectedMonth = $('#filterKeluarMonth').val();
    
    // If no month selected, reset the filter
    if (!selectedMonth) {
      tableKeluar.search('').draw();
      return;
    }

    // Format the selected month to match the YYYY-MM format
    tableKeluar.rows().every(function() {
      var rowDate = $(this.node()).find('td').eq(4).text().trim(); // Date column
      var rowMonth = rowDate.slice(0, 7); // Extract YYYY-MM format
      var match = rowMonth === selectedMonth;
      $(this.node()).toggle(match);
    });
  });
});

</script>