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
               <h2>Kasus</h2>
           </div>
           <div class="col-xs align-right">
               <a href="?new">Buat baru</a>
           </div>
       </div>
       <div class="row">
           <?php foreach($kasus as $k): ?>
           <div class="col-xs-4">
               <div class="panel">
                    <h3><?= $k['title'] ?></h3>
                    <p><?= date("d m Y", $k['created_at']) ?> - <i class="fas fa-user"></i> <?= $k['assigned'] ?></p>                
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