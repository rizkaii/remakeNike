<?php

session_start(); // Memulai session

$host = 'localhost';
$dbname = 'db_nike'; // Ganti dengan nama database Anda
$username = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses Login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT password, role FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $storedPassword, $role);  // Mengambil password dan role dari DB

    if (mysqli_stmt_fetch($stmt)) {
        // Periksa apakah password cocok langsung tanpa hashing
        if ($password === $storedPassword) {
            // Login berhasil, set session
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;  // Simpan role ke session

            // Arahkan berdasarkan role
            if ($role === 'admin') {
                header('Location: dashboard.php'); // Arahkan ke halaman admin
            } else {
                header('Location: beranda.php'); // Arahkan ke halaman user biasa
            }
            exit;
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Pengguna tidak ditemukan!";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);

?>
