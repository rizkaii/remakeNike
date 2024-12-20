<?php
session_start();
include 'db.php';

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login
    exit;
}

// Cek apakah ID produk dikirim melalui GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil path gambar dari database sebelum menghapus data
    $sql_select = "SELECT image_path FROM product WHERE id = $id";
    $result = mysqli_query($conn, $sql_select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image_path = $row['image_path'];

        // Hapus file gambar dari folder uploads jika file ada
        if (file_exists($image_path)) {
            unlink($image_path); // Hapus file dari server
        }

        // Hapus data produk dari database
        $sql_delete = "DELETE FROM product WHERE id = $id";
        if (mysqli_query($conn, $sql_delete)) {
            echo "Produk berhasil dihapus.";
            header('Location: index.php'); // Redirect ke halaman utama
            exit;
        } else {
            echo "Gagal menghapus produk: " . mysqli_error($conn);
        }
    } else {
        echo "Produk tidak ditemukan.";
    }
} else {
    echo "ID produk tidak diberikan.";
}
?>
