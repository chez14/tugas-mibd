<?php
require('config/autoload.php');

// Cek apakah dia mau bikin kasus baru...
if(isset($_GET['new'])) {
    View::render("kasus_baru.php", [
        'title'=>"Buat kasus baru"
    ]);
    exit();
}

// ini contoh bebrapa kasusnya, nanti lu sesuaikan aja sama
// yang ada di databasenya.

$kasus = [
    [
        "title" => "Refund #1",
        "id" => 1,
        "assigned" => "mark",
        "client" => "john-doe",
        "status" => "open",
        "created_at" => strtotime("24 april 2018 14:44")
    ],
    [
        "title" => "Refund #1",
        "id" => 2,
        "client" => "john-doe",
        "assigned" => "mark",
        "status" => "close",
        "created_at" => strtotime("24 april 2018 14:44")
    ]
];

View::render("kasus.php", ['kasus'=>$kasus]);