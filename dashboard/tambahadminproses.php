<?php
// Konfigurasi koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_nike";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah form telah di-submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Cek apakah username sudah ada di database
    $sqlCheck = "SELECT * FROM users WHERE username = '$username'";
    $resultCheck = $conn->query($sqlCheck);
    if ($resultCheck->num_rows > 0) {
        // Jika username sudah ada
        echo "<script>alert('Username sudah digunakan!'); window.history.back();</script>";
    } else {
        // Query untuk menambahkan pengguna baru
        $sql = "INSERT INTO users (name, username, password, role) VALUES ('$name', '$username', '$password', 'admin')";
        
        if ($conn->query($sql) === TRUE) {
            // Jika berhasil
            echo "<script>alert('Akun berhasil dibuat!'); window.location.href = 'dashboard.php';</script>";
        } else {
            // Jika gagal
            echo "<script>alert('Gagal membuat akun! Silakan coba lagi.'); window.history.back();</script>";
        }
    }
}

// Tutup koneksi
$conn->close();
?>
