<?php
session_start();
include 'db.php';

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('Location: ../login/index.php'); // Redirect ke halaman login jika belum login
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image_path = 'uploads/' . basename($_FILES['image']['name']);
    $created_by = $_SESSION['username'];  // Ambil username dari sesi

    // Upload gambar
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

    // Insert data ke database
    $sql = "INSERT INTO product (name, price, image_path, created_by) 
            VALUES ('$name', '$price', '$image_path', '$created_by')";

    if (mysqli_query($conn, $sql)) {
        echo "Produk berhasil ditambahkan.";
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!-- Form Create Product -->
<form method="POST" enctype="multipart/form-data">
    <label>Nama Produk:</label>
    <input type="text" name="name" required><br>

    <label>Harga Produk:</label>
    <input type="number" step="0.01" name="price" required><br>

    <label>Gambar Produk:</label>
    <input type="file" name="image" required><br>

    <button type="submit">Tambah Produk</button>
</form>
