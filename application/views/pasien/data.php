<section class="content">
  <div class="container-fluid">
    <div class="card shadow-lg">
      <div class="card-header">
        <div class="row">
          <div class="col d-flex">
            <h3 class="card-title align-self-center">Tabel <?= $title; ?></h3>
          </div>
          <div class="col text-right">
            <a href="<?= site_url('pasien/add'); ?>" class="btn btn-sm bg-info">
              <i class="fas fa-plus"></i> Daftar Pasien Baru
            </a>
            <a href="<?= site_url('laporan/pasien'); ?>" target="_blank" class="btn btn-sm btn-default">
              <i class="fas fa-print"></i> Laporan
            </a>
            <button id="btn-cetak" class="btn btn-sm btn-primary">
              <i class="fas fa-print"></i> Cetak Kartu
            </button>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive text-nowrap">
        <table class="table table-striped table-bordered datatable">
          <thead>
            <tr>
              <th><input type="checkbox" id="select-all"></th>
              <th>No RM</th>
              <th>No.Identitas</th>
              <th>Nama Pasien</th>
              <th>Tgl.Lahir</th>
              <th>No.Telp</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php if (count((array) $pasien) > 0) { ?>
            <?php foreach ($pasien as $row => $data) { ?>
              <tr>
                <td class="text-center">
                  <input type="checkbox" class="select-pasien" value="<?= $data->noRm; ?>">
                </td>
                <td><?=$data->noRm?></td>
                <td><?=$data->noIdentitas?></td>
                <td><?=$data->nmPasien?></td>
                <td><?=indo_date($data->tglLahir)?></td>
                <td><?=$data->noTelp?></td>
                <td><?=$data->alamat?></td>
                <td class="text-center" width="15%">
                  <div class="btn-group">
                    <a href="<?= site_url('pasien/pasienView/') . $data->noRm; ?>" class="btn btn-sm" style="background-color: #B0E0E6;">Riwayat</a>
                  </div>
                  <div class="btn-group">
                    <a id="show_dtl" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#modal-detail"
                      data-norm="<?=$data->noRm?>"
                      data-noidentitas="<?=$data->noIdentitas?>"
                      data-nmsuami="<?=$data->nmSuami?>"
                      data-nmpasien="<?=$data->nmPasien?>"
                      data-tgllahir="<?=indo_date($data->tglLahir)?>"
                      data-notelp="<?=$data->noTelp?>"
                      data-alamat="<?=$data->alamat?>"
                      data-tgldaftar="<?=indo_date($data->tglDaftar)?>"
                    ><i class="fas fa-eye"></i></a>
                    <a href="<?= site_url('pasien/edit/'.$data->noRm); ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                    <button class="btn btn-outline-danger btn-sm delete-btn" data-href="<?= base_url('pasien/delete/'.$data->noRm); ?>">
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

<div class="modal fade" id="modal-detail">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-info pb-2 pt-2">
        <h4 class="modal-title">Detail Pasien</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th width="35%">No. RM</th>
              <td><span id="noRm" class="text-bold"></span></td>
            </tr>
            <tr>
              <th>No Identitas</th>
              <td><span id="noIdentitas"></span></td>
            </tr>
            <tr>
              <th>Nama Suami</th>
              <td><span id="nmSuami"></span></td>
            </tr>
            <tr>
              <th>Nama Pasien</th>
              <td><span id="nmPasien"></span></td>
            </tr>
            <tr>
              <th>Tgl Lahir</th>
              <td><span id="tglLahir"></span></td>
            </tr>
            <tr>
              <th>No. Telp</th>
              <td><span id="noTelp"></span></td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td><span id="alamat"></span></td>
            </tr>
            <tr>
              <th>Terdaftar Pada</th>
              <td><span id="tglDaftar"></span></td>
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
    $('#select-all').on('click', function() {
      $('.select-pasien').prop('checked', this.checked);
    });

    $('#btn-cetak').on('click', function() {
      var selected = [];
      $('.select-pasien:checked').each(function() {
        selected.push($(this).val());
      });

      if (selected.length > 0) {
        var url = "<?= site_url('laporan/cetakMultipleKartuIbu/'); ?>" + selected.join(',');
        window.open(url, '_blank');
      } else {
        alert('Pilih setidaknya satu pasien untuk mencetak.');
      }
    });

    $(document).on('click', '#show_dtl', function() {
      var data = $(this).data();
      $('#noRm').text(data.norm);
      $('#noIdentitas').text(data.noidentitas);
      $('#nmSuami').text(data.nmsuami);
      $('#nmPasien').text(data.nmpasien);
      $('#tglLahir').text(data.tgllahir);
      $('#noTelp').text(data.notelp);
      $('#alamat').text(data.alamat);
      $('#tglDaftar').text(data.tgldaftar);
    });
  });
</script>
