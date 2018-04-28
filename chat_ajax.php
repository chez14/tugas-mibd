<?php
require('config/autoload.php');
Helper\Ajaxify::boot();
$user = Model\User::fetch_user();
if($user == null) {
    Helper\Ajaxify::error("User not authenticated.",403);
}
$pesan = [];
try {
    if(isset($_POST['konten'])) {
        $inserted_id = Model\Pesan::add_pesan($_POST['konten'], $_POST['kasus'], $user['id']);
        $pesan = Model\Pesan::get_pesan_since_id($inserted_id, $_POST['kasus']);
    } else {
        $pesan = Model\Pesan::get_pesan($_GET['id'], $_GET['last']);
    }
} catch (\Exception $e){
    Helper\Ajaxify::error($e->getMessage(),500);    
}

Helper\Ajaxify::serve(array_map(function($data){
    $data['is_client'] = $data['klien_id']!=null;
    $data['created_at'] = strtotime($data['created_at']);
    return $data;
}, $pesan));