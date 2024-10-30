<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 300px;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        small {
            display: block;
            margin-top: 4px;
        }
        .text-right {
            text-align: right;
        }
        hr {
            border: 0;
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        @media print {
            button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><?= $title ?></h2>
            <p style="margin-bottom: 0;">Periksa: <?= indo_date($detail->tglPeriksa); ?></p>
            <small><?= $detail->nmPasien ?></small>
        </div>
        <table>
            <tr>
                <th>Biaya Pelayanan</th>
                <td class="text-right"><?= indo_currency($biaya_pelayanan); ?></td>
            </tr>
            <tr>
                <th colspan="2">Biaya Obat</th>
            </tr>
            <?php foreach ($obat as $o) { 
                $harga_total_obat = $o->hargaObat * $o->jumlahObat;
            ?>
                <tr>
                    <td>+ <?= $o->nmObat ?> (x<?= $o->jumlahObat ?>)</td>
                    <td class="text-right"><?= indo_currency($harga_total_obat); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td class="text-right"><?= indo_currency($total_harga); ?></td>
            </tr>
        </table>
        <button onclick="window.print()">Cetak Struk</button>
    </div>
</body>
</html>
