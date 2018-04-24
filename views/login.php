<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= $this->include('_part/header.php'); ?>
    <style>
        .make-fullscreen {
            height: 100vh;
        }

        body {
            background-color: var(--color-blue-200);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row center-xs middle-xs make-fullscreen">
            <div class="col-xs-6">
                <h1>Login</h1>
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" placeholder="username anda">
                    </div>
                    <div class="form-group">
                        <label for="">Pass</label>
                        <input type="password" name="password" placeholder="username anda">
                    </div>

                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>