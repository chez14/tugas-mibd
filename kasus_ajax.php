<?php
require('config/autoload.php');
Helper\Ajaxify::boot();

$user = Model\User::fetch_user();

if($user == null) {
    Helper\Ajaxify::error("User not authenticated.",403);
}

try {
    if(!isset($_POST['action']) || !isset($_POST['case']))
        throw new Exception("You need to specify both the action and the case id!");
    
    if($_POST['action'] == 'close') {
        \Model\Kasus::close_kasus($_POST['case']);

        return Helper\Ajaxify::serve(["status"=>"done"]);
    } else if ($_POST['action'] == 'self-assign') {
        \Model\Kasus::assign_kasus($_POST['case'], $user['id']);
        
        return Helper\Ajaxify::serve(["status"=>"done"]);
                
    } else if ($_POST['action'] == 'assign') {
        if(!isset($_POST['karyawan']))
            throw new Exception("You need to specify the assigned karyawan username/email!");

        $k_id = Model\User::get_user($_POST['karyawan']);

        if(!$k_id || $k_id[0]['role'] != 'karyawan')
            throw new Exception("the specified karyawan username/email are invalid!");    

        \Model\Kasus::assign_kasus($_POST['case'], $k_id[0]['id']);
        
        return Helper\Ajaxify::serve(["status"=>"done"]);        
    } else {
        throw new Exception("Action doesn't found. Better luck next time.");
    }
} catch (\Exception $e) {
    Helper\Ajaxify::error($e->getMessage(),400);    
}