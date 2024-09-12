<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'dbcompro';

$koneksi = new mysqli($host, $user, $pass, $db);
if ($koneksi->connect_errno) {
    echo 'gagal koneksi karena' . $koneksi->connect_error;
}