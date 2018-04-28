<?php
require('config/autoload.php');
Helper\Ajaxify::boot();
$user = Model\User::fetch_user();
if($user == null) {
    Helper\Ajaxify::error(["error"=>"User not authenticated."],403);
}
if(isset($_POST['konten'])) {
    $inserted_id = Model\Pesan::add_pesan($_POST['konten'], $_POST['kasus'], $user['id']);
    $pesan = Model\Pesan::get_pesan_since_id($inserted_id, $_POST['kasus']);
} else {
    $pesan = Model\Pesan::get_pesan($_POST['kasus'], $_POST['last']);
}

Helper\Ajaxify::serve(array_map(function($data){
    $data['is_client'] = $data['klien_id']!=null;
    return $data;
}, $pesan));