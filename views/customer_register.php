<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= $this->include('_part/header.php'); ?>
</head>
<body>
    <?= $this->include('_part/navbar.php'); ?>
    <div class="hero is-dark">
        <div class="container">
            <div class="row">
                <div class="col-xs">
                    <h1>Get an account!</h1>
                </div>
                <div class="col-xs">
                    <h3>Register</h3>
                    <?php if($error): ?>
                    <div style="padding:15px; background-color:white; color:var(--font-normal);">
                        <?=$error?>
                    </div>
                    <?php endif; ?>
                    <form action="customer_register.php" method="post">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" placeholder="john">
                        </div>
                        <div class="form-group">
                            <label for="">Pass</label>
                            <input type="password" name="password" placeholder="password anda">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="name" placeholder="John doe">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" placeholder="John doe">
                        </div>

                        <button type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>