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
               <h2>Kasus baru</h2>
           </div>
           <div class="col-xs align-right">
               <a href="javascript:history.goBack();">Kembali</a>
           </div>
       </div>
       <div class="row">
           <form action="kasus.php" method="post">
                <div class="form-group">
                    <label for="">Judul</label>
                    <input type="text" name="title" placeholder="Judul masalah anda">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi masalah</label>
                    <textarea name="problem" placeholder="Ceritakan masalah anda"></textarea>
                </div>

                <button type="submit">Buat Kasus</button>
           </form>
       </div>
   </div>
   <?= $this->include('_part/footer.php'); ?>
</body>
</html>