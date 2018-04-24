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
                    <form action="index.php">
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

                        <button type="submit">Login</button>
                        <a href="customer_register.php">Register</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>