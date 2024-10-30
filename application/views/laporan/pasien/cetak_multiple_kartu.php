<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $title; ?></title>
    <style type="text/css">
        .page {
            page-break-after: always;
        }
        .container {
            width: 85mm;
            height: 55mm;
            border: 1px solid #000;
            padding: 5mm;
            box-sizing: border-box;
            margin: 0 auto;
            float: left;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .header {
            text-align: center;
            color: red;
            font-weight: bold;
            margin-bottom: 2mm;
        }
        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 2mm;
        }
        .line {
            border: none;
            border-top: 1px solid black;
            margin: 2mm 0;
        }
        .content {
            margin-bottom: 2mm;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content td {
            padding: 2px 0;
        }
        .footer {
            text-align: center;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php foreach ($pasien_list as $pasien) { ?>
        <div class="page">
            <div class="container">
                <div class="header">
                    E-Bidan Ari
                </div>
                <div class="title">
                    KARTU IBU
                </div>
                <hr class="line">
                <div class="content">
                    <table>
                        <tr>
                            <td><strong>NORM</strong></td>
                            <td><strong>:</strong></td>
                            <td><strong><?= $pasien->noRm ?></strong></td>
                        </tr>
                        <tr>
                            <td>No. Identitas</td>
                            <td>:</td>
                            <td><?= $pasien->noIdentitas ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $pasien->nmPasien ?></td>
                        </tr>
                        <tr>
                            <td>Tgl. Lahir</td>
                            <td>:</td>
                            <td><?= indo_date($pasien->tglLahir) ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?= $pasien->alamat ?></td>
                        </tr>
                    </table>
                </div>
                <hr class="line">
            </div>
        </div>
    <?php } ?>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
