<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?=base_url().'assets/dist/css/cetak.css'?>">
    <title>Laporan <?=$title?></title>
</head>
<body>

<table border="0" style="position: absolute; top: 20px; left: 20px;">
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
<hr class="line-title-thin">

<p align="center"><b>Laporan <?=$title?></b></p>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>No.Registrasi</th>
        <th>No RM</th>
        <th>No Identitas</th>
        <th>Nama Pasien</th>
        <th>Waktu Kunjungan</th>
    </tr>
    <?php $no = 1; foreach ($registrasi as $row) { ?>
    <tr>
        <td><?=$no++?>.</td>
        <td><?=$row->noRegistrasi?></td>
        <td><?=$row->noRm?></td>
        <td><?=$row->noIdentitas?></td>
        <td><?=$row->nmPasien?></td>
        <td><?=indo_date($row->tglKunjungan)?></td>
    </tr>
    <?php } ?>
</table>
<button onclick="history.go(-1)" style="background-color: red;">Kembali</button>
<button onclick="window.print()">Cetak</button>

</body>
</html>
