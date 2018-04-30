<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= $this->include('_part/header.php'); ?>
    <style>
        .profile-user p{
            margin: 0px;
        }
        .img-circle {
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <?= $this->include('_part/navbar.php'); ?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-xs">
                <h2>Laporan</h2>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <div class="panel">
                    <h2><?= count($case_open) ?> Kasus</h2>
                    <p>terbuka dan belum ter<i>solved</i>.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel">
                    <h2><?= count($case_unassign) ?> Kasus</h2>
                    <p>belum di assign ke karyawan manapun</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel">
                    <h2><?= count($karyawan_free) ?> Karyawan</h2>
                    <p>yang saat ini sedang tidak mengurusi kasus manapun</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel">
                    <h2><?= $case_rata_rata ?> Hari</h2>
                    <p>waktu rata-rata sebuah kasus diselesaikan</p>
                </div>
            </div>    
        </div>

        <div class="row">
            <div class="col-xs mt-2">
                <h2>Karyawan yang free</h2>
            </div>
        </div>
        <div class="row">
            <?php foreach($karyawan_free as $user): ?>
            <div class="col-xs-3">
                <div class="panel profile-user">
                    <div class="row">
                        <div class="col-xs-3 col-xl-2">
                            <img class="img-circle" src="<?= Helper\Gravatar::get_gravatar($user['email']) ?>" alt="">
                        </div>
                        <div class="col-xs-9 col-xl-10">
                            <p class="nama"><?=$user['name']?></p>
                            <p>#<?=$user['id']?> - <b>@<?= $user['username'] ?></b></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <div class="col-xs mt-2">
                <h2>Kasus terbuka, namun belum ada yang di assign</h2>
            </div>
        </div>
        <div class="row">
            <?php foreach($case_unassign as $k):
                    $k['status'] = $k['closed_at']?"close":"open";
                ?>
            <div class="col-xs-4">
                <div class="panel">
                        <h3><?= $k['nama'] ?></h3>
                        <p><i class="fas fa-user"></i> <?= $k['karyawan_nama']?:"<i>Belum di assign</i>" ?></p>                
                        <div class="ticket <?=$k['status']=='open'?'ticket-open':'ticket-close'?>">
                            Status: <?= $k['status'] ?>
                        </div>
                        <p><a href="chat.php?id=<?=$k['id']?>">Lihat kasus lebih detil <i class="fas fa-angle-double-right"></i></a></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
   <?= $this->include('_part/footer.php'); ?>
</body>
</html>