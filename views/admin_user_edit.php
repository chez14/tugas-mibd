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
                <h2>User Editor: <?= $user['name']?:"Baru" ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-9">
                <?php if($laporan): ?>
                <div style="padding:15px; background-color:white; color:var(--font-normal);">
                    <?=$laporan?>
                </div>
                <?php endif; ?>
                <div class="panel">
                    <form action="admin_user_edit.php" method="post">
                        <div class="form-group">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" value="<?= $user['email'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $user['username'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <?php if($user): ?>
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   <?= $this->include('_part/footer.php'); ?>   
</body>
</html>