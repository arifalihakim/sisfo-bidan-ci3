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

<p align="center"><b>Laporan <?=$title?></b></p>

<hr class="line-title-thin">


<table border="0">
    <tr>
        <td>ID Periksa</td>
        <td width="300px">:&nbsp;<b><?=$detail->idPeriksa?></b></td>
        <td width="150px"></td>
        <td>Tgl Daftar</td>
        <td>:&nbsp;<?=indo_date($detail->tglDaftar)?></td>
    </tr>
    <tr>
        <td>Nama Pasien</td>
        <td width="300px">:&nbsp;<b><?=$detail->nmPasien?></b></td>
        <td width="150px"></td>
        <td>Alamat</td>
        <td>:&nbsp;<?=$detail->alamat?></td>
    </tr>
    <tr>
        <td>Usia&nbsp;Kehamilan</td>
        <td>:&nbsp;<?=$detail->uk?>&nbsp;minggu</td>
        <td></td>
        <td>Berat&nbsp;Badan</td>
        <td>:&nbsp;<?=$detail->bb?>&nbsp;Kg</td>
    </tr>
</table>
<br>
<table border="1" cellspacing="0px" cellpadding="4">
    <tr>
        <th width="150px">Tgl Periksa</th>
        <th width="80px">TD</th>
        <th width="80px">TFU</th>
        <th width="80px">Letak</th>
        <th width="80px">DJJ</th>
        <th>Keluhan</th>
        <th>Tindak Lanjut</th>
        <th width="300px">Diagnosa</th>
        <th>Bidan</th>
    </tr>
    <tr>
        <td align="center"><?=indo_date($detail->tglPeriksa)?></td>
        <td align="right"><?=$detail->sistol?>/<?=$detail->diastol?></td>
        <td align="right"><?=$detail->tfu?>&nbsp;cm</td>
        <td align="left"><?=$detail->letak?></td>
        <td align="right"><?=$detail->djj?>&times;/mnt</td>
        <td align="left"><?=$detail->keluhan?></td>
        <td align="left"><?=$detail->tindakLanjut?></td>
        <td align="left"><?=$detail->diagnosa?></td>
        <td><?=$detail->fullName?></td>
    </tr>
    </table>
<br>
<table border="0" cellspacing="0px" cellpadding="5">
    <b>Nama Obat&nbsp;:</b>
<tbody>
    <?php $no=1; foreach ($obat as $o) { ?>
        <tr>
            <td><?=$no++?>.&nbsp;<?= $o->nmObat ?>&nbsp;( x<?= $o->jumlahObat ?> )&nbsp;&nbsp;&nbsp;aturan : <?= $o->aturan ?></td>
        </tr>
    <?php } ?>
                    
    </tbody>
</table>

</body>
</html>

<script type="text/javascript">
    window.print()
</script>
