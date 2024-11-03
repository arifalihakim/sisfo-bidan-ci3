    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
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
                <div class="row">
                  <div class="col-sm p-0">
                  	<table class="w-100 table-sm table-hover">
                      <tr>
                      	<th width="150">ID Periksa</th>
                      	<td>: <b><?= $detail->idPeriksa; ?></b></td>
                      </tr>
                      <tr>
                        <th width="150">No Registrasi</th>
                        <td>: <b><?= $detail->noRegistrasi; ?></b></td>
                      </tr>
                      <tr>
                        <th width="150">No.RM</th>
                        <td>: <?=$detail->noRm?></td>
                      </tr>
                      <tr>
                        <th width="150">No.Identitas</th>
                        <td>: <?=$detail->noIdentitas?></td>
                      </tr>
                      <tr>
                      	<th width="150">Pasien</th>
                      	<td>: <?= $detail->nmPasien; ?></td>
                      </tr>
                      <tr>
                      	<th width="150">Berat Badan</th>
                      	<td>: <?=!empty($detail->bb) ? $detail->bb." Kg" : ""?></td>
                      </tr>
                      <tr>
                      	<th width="150">Usia Kehamilan</th>
                      	<td>: <?=!empty($detail->uk) ? $detail->uk." Minggu" : "-"?></td>
                      </tr>
                      <tr>
                      	<th width="150">Tekanan Darah</th>
                      	<td>: <?= $detail->sistol; ?>/<?= $detail->diastol; ?></td>
                      </tr>
                      <tr>
                      	<th width="150">Tinggi Fundus Uteri</th>
                      	<td>: <?=!empty($detail->tfu) ? $detail->tfu." cm" : "-"?></td>
                      </tr>
                      <tr>
                      	<th width="150">Letak</th>
                      	<td>: <?=!empty($detail->letak) ? $detail->letak."" : "-"?></td>
                      </tr>
                      <tr>
                      	<th width="150">D.Jantung Janin</th>
                      	<td>: <?=!empty($detail->djj) ? $detail->djj." &times;/mnt" : "-"?></td>
                      </tr>
                      <tr>
                        <th width="150">Keluhan</th>
                        <td>: <?= $detail->keluhan; ?></td>
                      </tr>
                      <tr>
                        <th width="150">Tindak lanjut</th>
                        <td>: <?= $detail->tindakLanjut; ?></td>
                      </tr>
                      <!-- <tr>
                      	<th width="150">Buku KIA</th>
                      	<td>: <?= $detail->kia; ?></td>
                      </tr> -->
                      <tr>
                      	<th width="150">Imunisasi</th>
                      	<td>: <?=!empty($detail->imunisasi) ? $detail->imunisasi."" : "-"?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-sm p-0">
                  	<table class="w-100 table-sm table-hover">
                  		<tr>
                  			<th width="150">Tanggal Periksa</th>
                  			<td>: <?= indo_date($detail->tglPeriksa); ?></td>
                  		</tr>
                  		<tr>
                  			<th width="150">Bidan</th>
                  			<td>: <?= $detail->fullName; ?></td>
                  		</tr>
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
                            <li><?= $o->nmObat ?>&nbsp;( x<?= $o->jumlahObat ?> )&nbsp;&nbsp;&nbsp;aturan : <?= $o->aturan ?></li>
                          <?php } ?>
                        </ol>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          <div class="col-md-4">
            <div class="card shadow-lg">
              <div class="card-header bg-fuchsia">
                <h3 class="card-title">Rincian Biaya</h3>
              </div>
              <div class="card-body">
                <div class="row mb-3">
                  <table class="w-100 table-sm table-hover">
                    <tr>
                      <th>Biaya Pelayanan</th>
                      <td class="text-right">
                        <?= indo_currency($biaya_pelayanan); ?>
                      </td>
                    </tr>
                    <tr>
                      <th colspan="2">Biaya Obat</th>
                    </tr>
                    <?php 
                    $total_harga_obat = 0;
                    foreach ($obat as $o) { 
                      $total_harga_item = $o->hargaObat * $o->jumlahObat;
                      $total_harga_obat += $total_harga_item;
                    ?>
                      <tr>
                        <td>+ <?= $o->nmObat ?> (x<?= $o->jumlahObat ?>)</td>
                        <td class="text-right">
                          <?= indo_currency($total_harga_item); ?>
                        </td>
                      </tr>
                    <?php } ?>
                    <tr>
                      <td colspan="2">
                        <hr>
                      </td>
                    </tr>
                    <tr>
                      <th>Total Harga</th>
                      <td class="text-right">
                        <?= indo_currency($total_harga_obat + $biaya_pelayanan); ?>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>