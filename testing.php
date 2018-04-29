<?php
require('config/autoload.php');

// Model\Pesan::add_pesan_karyawan("Test!", 1, 1);
// echo "Insersi berhasil!\n";

$kasus = Model\Kasus::get_all_kasus();
var_dump($kasus);

echo "\n";