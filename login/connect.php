<?php

$host = 'localhost';
$dbname = 'db_nike'; // Ganti dengan nama database Anda
$username = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $dbname);

if ($conn) {
    echo "Koneksi berhasil";
} else {
    echo "Koneksi gagal: " . mysqli_connect_error();
}

?>
