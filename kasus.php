<?php
require('config/autoload.php');

// Cek apakah dia mau bikin kasus baru...
if(isset($_GET['new'])) {
    View::render("kasus_baru.php", [
        'title'=>"Buat kasus baru"
    ]);
    exit();
}
$user = Model\User::fetch_user();
if(!$user) {
    header("Location: index.php");
    exit();
}

$kasus = [];
if($user['role'] == 'client') {
    $kasus = Model\Kasus::get_kasus_by_user($user['id']);
} else {
    // custom made. Karna ganti rencana.

    if($user['role'] == 'pemilik') {
        //dahulukan yang belum di assign.
        $statement = Config::get_db()->prepare("SELECT * FROM kasus_lengkap ORDER BY closed_at ASC, id ASC, karyawan_id ASC");
        $statement->execute();
        $kasus = Helper\DB::fetch_all($statement->get_result());
    } else {
        //dahulukan yang dia diassign
        $statement = Config::get_db()
            ->prepare("SELECT ABS(karyawan_id - ?) as koefisien, kasus_lengkap.* " . 
                "FROM kasus_lengkap ORDER BY (case when koefisien is null then 1 else 0 end), koefisien ASC, closed_at ASC, id ASC");
        $statement->bind_param("i", $user['id']);
        $statement->execute();
        $kasus = Helper\DB::fetch_all($statement->get_result());        
    }
}

$kasus = array_map(function($data){
    $data['status'] = ($data['closed_at']?"closed":"open");
    return $data;
}, $kasus);

View::render("kasus.php", ['kasus'=>$kasus]);