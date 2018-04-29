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
                <h2>User Panel: <?= $user_type ?></h2>
            </div>
        </div>
        <div class="row">
            <?php if($laporan): ?>
            <div style="padding:15px; background-color:white; color:var(--font-normal);">
                <?=$laporan?>
            </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php foreach($users as $user): ?>
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
                    <div class="row">
                        <div class="col-xs align-right">
                            <a href="admin_user_edit.php?id=<?=$user['id']?>" class="btn btn-sm btn-dark"><i class="fas fa-pencil-alt"></i></a>
                            <a href="admin_user.php?delete=<?=$user['id']?>&amp;tipe=<?= $_GET['tipe']?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?= $this->include('_part/footer.php'); ?>    
</body>
</html>