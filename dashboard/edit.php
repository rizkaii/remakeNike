<?php
// Memulai session untuk memeriksa status login
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login/index.php");
    exit();
}
?>

<?php
// Memulai session untuk memeriksa status login


// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login/index.php");
    exit();
}

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

// Ambil data artikel berdasarkan id
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM product WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Product tidak ditemukan!'); window.history.back();</script>";
        exit;
    }
} else {
    echo "<script>alert('ID Product tidak ditemukan!'); window.history.back();</script>";
    exit;
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    
    // Hapus simbol '$' dari input harga
    $price = mysqli_real_escape_string($conn, str_replace('$', '', $_POST['price']));
    
    // Validasi apakah input harga valid
    if (!is_numeric($price)) {
        echo "<script>alert('Harga harus berupa angka!'); window.history.back();</script>";
        exit;
    }
    
    $gambarLama = $row['image_path'];

    // Proses upload gambar baru jika ada
    $gambarBaru = $gambarLama; // Default ke gambar lama
    if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['image_path']['tmp_name'];
        $fileName = uniqid() . '_' . $_FILES['image_path']['name'];
        $filePath = "../product/" . $fileName;

        // Hapus gambar lama jika ada
        if (file_exists("../product/" . $gambarLama)) {
            unlink("../product/" . $gambarLama);
        }

        // Simpan gambar baru
        if (move_uploaded_file($fileTmp, $filePath)) {
            $gambarBaru = $fileName;
        } else {
            echo "<script>alert('Gagal mengunggah gambar baru!'); window.history.back();</script>";
            exit;
        }
    }

    // Update data di database
    $sqlUpdate = "UPDATE product SET name = '$name', price = '$price', image_path = '$gambarBaru' WHERE id = $id";
    if ($conn->query($sqlUpdate) === TRUE) {
        echo "<script>alert('Product berhasil diperbarui!'); window.location.href = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui Product!'); window.history.back();</script>";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    height: 100vh;
}

header {
    background-color: #333;
    color: white;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    position: fixed;
    width: 100%;
}
p{
    display: -webkit-box;       /* Aktifkan model kotak fleksibel */
    -webkit-line-clamp: 3;      /* Maksimum 3 baris */
    -webkit-box-orient: vertical; /* Orientasi vertikal */
    overflow: hidden;           /* Sembunyikan teks yang melebihi */
}

#menu-toggle {
    background: none;
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    margin-right: 20px;
}

#sidebar {
    width: 250px;
    background-color: #333;
    color: white;
    height: 100%;
    position: fixed;
    top: 0;
    left: -250px;
    transition: left 0.3s ease;
    margin-top: 60px;
}

#sidebar ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

#sidebar ul li {
    padding: 15px;
    border-bottom: 1px solid #555;
}

#sidebar ul li a {
    color: white;
    text-decoration: none;
}

#sidebar.active {
    left: 0;
    margin-top: 60px;
    background-color: #333;
}

main {
    margin-left: 0;
    padding: 20px;
    transition: margin-left 0.3s ease;
}

main.active {
    margin-left: 250px;
}
.main-content{
    margin-top: 70px;
}
</style>

</head>
<body>
    <!-- Sidebar and Main Content -->
    <header>
        <button id="menu-toggle">☰</button>
        <h1>Dashboard</h1>
    </header>
    
    <nav id="sidebar">
        <ul>
            <li><a href="dashboard.php">Semua Artikel</a></li>
            <li><a href="upload.php">Tambah Artikel</a></li>
            <li><a href="tambahadmin.php">Tambah Admin</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>


        <!-- Main Content -->
        <div class="main-content flex-fill">

        <div class="container mt-5">
    <h1>Edit Artikel</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
        </div>
        <!-- <div class="mb-3">
            <label for="price" class="form-label">price</label>
            <input type="text" class="form-control" id="name" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
            
        </div> -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" 
                placeholder="ex: 150.00" 
                value="<?php echo htmlspecialchars($row['price']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="image_path">
            <p class="mt-2">Gambar saat ini:</p>
            <img src="../product/<?php echo htmlspecialchars($row['image_path']); ?>" alt="Gambar Artikel" style="max-width: 200px;">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
