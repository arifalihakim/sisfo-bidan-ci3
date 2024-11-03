<section class="content">
  <div class="container-fluid">
    <div class="row">
      
      <!-- Form Card -->
      <div class="col-md-8">
        <div class="card shadow-lg">
          <div class="card-header bg-fuchsia">
            <h3 class="card-title">Form <?= $title; ?></h3>
            <div class="card-tools">
              <a onclick="history.go(-1);" class="btn btn-tool"><i class="fas fa-times text-white"></i></a>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <!-- Left Table -->
              <div class="col-sm p-0">
                <table class="w-100 table-sm table-hover">
                  <?php
                  $details = [
                    "ID Periksa" => $detail->idPeriksa,
                    "No Registrasi" => $detail->noRegistrasi,
                    "No.RM" => $detail->noRm,
                    "No.Identitas" => $detail->noIdentitas,
                    "Pasien" => $detail->nmPasien,
                    "Berat Badan" => !empty($detail->bb) ? $detail->bb . " Kg" : "",
                    "Usia Kehamilan" => !empty($detail->uk) ? $detail->uk . " Minggu" : "-",
                    "Tekanan Darah" => "{$detail->sistol}/{$detail->diastol}",
                    "Tinggi Fundus Uteri" => !empty($detail->tfu) ? $detail->tfu . " cm" : "-",
                    "Letak" => !empty($detail->letak) ? $detail->letak : "-",
                    "D.Jantung Janin" => !empty($detail->djj) ? $detail->djj . " ×/mnt" : "-",
                    "Keluhan" => $detail->keluhan,
                    "Tindak lanjut" => $detail->tindakLanjut,
                    "Imunisasi" => !empty($detail->imunisasi) ? $detail->imunisasi : "-",
                  ];
                  foreach ($details as $key => $value) {
                    echo "<tr><th width='150'>$key</th><td>: <b>$value</b></td></tr>";
                  }
                  ?>
                </table>
              </div>

              <!-- Right Table -->
              <div class="col-sm p-0">
                <table class="w-100 table-sm table-hover">
                  <tr><th width="150">Tanggal Periksa</th><td>: <?= indo_date($detail->tglPeriksa); ?></td></tr>
                  <tr><th width="150">Bidan</th><td>: <?= $detail->fullName; ?></td></tr>
                </table>

                <div class="card shadow-md bg-light mt-5">
                  <div class="card-body">
                    <h5>Diagnosa :</h5>
                    <p><?= $detail->diagnosa; ?></p>
                  </div>
                </div>

                <div class="card shadow-md bg-light mt-3">
                  <div class="card-body">
                    <h5>Resep :</h5>
                    <ol class="ml-0">
                      <?php foreach ($obat as $o) { ?>
                        <li><?= $o->nmObat ?> (x<?= $o->jumlahObat ?>) aturan: <?= $o->aturan ?></li>
                      <?php } ?>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Rincian Biaya Card -->
      <div class="col-md-4">
        <div class="card shadow-lg">
          <div class="card-header bg-fuchsia">
            <h3 class="card-title">Rincian Biaya</h3>
          </div>
          <div class="card-body">
            <table class="w-100 table-sm table-hover">
              <tr><th>Biaya Pelayanan</th><td class="text-right"><?= indo_currency($biaya_pelayanan); ?></td></tr>
              <tr><th colspan="2">Biaya Obat</th></tr>
              <?php 
              $total_harga_obat = 0;
              foreach ($obat as $o) { 
                $total_harga_item = $o->hargaObat * $o->jumlahObat;
                $total_harga_obat += $total_harga_item;
              ?>
                <tr><td>+ <?= $o->nmObat ?> (x<?= $o->jumlahObat ?>)</td><td class="text-right"><?= indo_currency($total_harga_item); ?></td></tr>
              <?php } ?>
              <tr><td colspan="2"><hr></td></tr>
              <tr><th>Total Harga</th><td class="text-right"><?= indo_currency($total_harga_obat + $biaya_pelayanan); ?></td></tr>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
