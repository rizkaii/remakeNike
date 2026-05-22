<?php
session_start();

// Konfigurasi database
include '../config.php';

// Proses form saat tombol Sign up diklik
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = 'user'; // Kolom role otomatis terisi 'user'

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO users (name, username, password, role) VALUES ('$name', '$username', '$password', 'user')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Akun berhasil dibuat!');
            window.location.href = 'index.php'; 
        </script>";
    } else {
        echo "<script>
            alert('Gagal membuat akun: " . mysqli_error($conn) . "');
            window.history.back(); 
        </script>";
    }
}

// Tutup koneksi
mysqli_close($conn);
?>
