<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= $this->include('_part/header.php'); ?>
    <style>
        body {
            background-color: var(--color-blue-200);
        }
    </style>
</head>
<body>
    <?= $this->include('_part/navbar.php'); ?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-xs">
                <h2>Administrator Panel</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <div class="panel">
                    <h3>Kasus (<?= $kasus_open ?> open)</h3>
                    <a class="btn btn-dark" href="kasus.php">Lihat kasus</a>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="panel">
                    <h3>Karyawan (<?= $karyawan_open ?> free dari <?= $karyawan_total ?> orang)</h3>
                    <a class="btn btn-dark" href="admin_user.php?tipe=karyawan">Atur Karyawan</a>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="panel">
                    <h3>Klien (<?= $klien_total ?> orang)</h3>
                    <a class="btn btn-dark" href="admin_user.php?tipe=klien">Atur Klien</a>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="panel">
                    <h3>Laporan</h3>
                    <a class="btn btn-dark" href="laporan.php">Lihat Laporan Lengkap</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>