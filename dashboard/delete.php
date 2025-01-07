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

// Cek apakah parameter id ada di URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan id adalah integer

    // Query untuk mengambil data artikel berdasarkan id
    $sqlGet = "SELECT * FROM product WHERE id = $id";
    $resultGet = $conn->query($sqlGet);

    if ($resultGet->num_rows > 0) {
        $row = $resultGet->fetch_assoc();
        $filePath = '../product/' . $row['image_path']; // Path file gambar

        // Cek apakah file gambar ada di folder
        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file gambar
        }

        // Query untuk menghapus data artikel
        $sqlDelete = "DELETE FROM product WHERE id = $id";
        if ($conn->query($sqlDelete) === TRUE) {
            echo "<script>alert('Product dan gambar berhasil dihapus!'); window.location.href = 'dashboard.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus Product! Silakan coba lagi.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Product tidak ditemukan!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ID Product tidak ditemukan!'); window.history.back();</script>";
}

// Tutup koneksi
$conn->close();
?>
