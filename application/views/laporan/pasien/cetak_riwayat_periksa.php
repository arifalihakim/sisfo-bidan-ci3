<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?=base_url().'assets/dist/css/cetak.css'?>">
    <title>Laporan <?=$title?></title>
</head>
<body>

<table border="0"style="position: absolute; top: 20px; left: 20px;">
    <tr>
        <td>Pencetak</td>
        <td>:&nbsp;<?= userdata('fullName') ?></td>
    </tr>
    <tr>
        <td>Alamat Praktek</td>
        <td>:&nbsp;Jl.Citrosancakan, Dusun 1, Gandurejo, Gemolong, Sragen, Jateng</td>
    </tr>
    <tr>
        <td>Kode Pos</td>
        <td>:&nbsp;50274</td>
    </tr>
    <tr>
        <td>Wa/Telp</td>
        <td>:&nbsp;0823-1492-5552</td>
    </tr>
    <tr>
        <td>Tgl Cetak</td>
        <td>:&nbsp;<?=date('d/m/Y')?></td>
    </tr>
</table>
<div class="header">
    <img src="<?= base_url().'assets/dist/img/ikatan_bidan.png'?>" alt="Logo" class="logo">
</div>


<hr class="line-title">

<p align="center"><b>Laporan <?=$title?><br>
    <span class="text-bold text-center">
        <?php if (!empty($pasienView)) { ?>
            <?= $pasienView[0]->nmPasien; ?> - <?= $pasienView[0]->noRm; ?>
        <?php } ?>  
      </span>
</b></p>

<hr class="line-title-thin">


<br>
<table border="1" cellspacing="0px" cellpadding="4">
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
        <th>Tindak Lanjut</th>
        <th>Diagnosa</th>
    </tr>
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
          <td><?= $row->keluhan ?></td>
          <td><?= $row->tindakLanjut ?></td>
          <td><?=!empty($row->imunisasi) ? $row->imunisasi."" : "-"?></td>
          <td width="20%"><?= $row->diagnosa ?></td>
        </tr>
      <?php } ?>
    <?php } ?>
    </table>

</body>
</html>

<script type="text/javascript">
    window.print()
</script>
