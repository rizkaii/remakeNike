<?php

include '../config.php';

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $dbname);

if ($conn) {
    echo "Koneksi berhasil";
} else {
    echo "Koneksi gagal: " . mysqli_connect_error();
}

?>
