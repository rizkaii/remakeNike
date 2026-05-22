<?php
// Memulai session untuk memeriksa status login
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login/index.php");
    exit();
}

// Konfigurasi koneksi database
include '../config.php';

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
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
body {
    font-family: 'Jost', Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f6f9;
}

header {
    background: linear-gradient(135deg, #1f1f1f, #0a0a0b);
    color: white;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    position: fixed;
    width: 100%;
    z-index: 1050;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

header h1 {
    font-size: 1.5rem;
    margin: 0;
}

p {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin: 0;
}

#menu-toggle {
    background: none;
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    margin-right: 20px;
    transition: 0.3s;
}

#menu-toggle:hover {
    color: #ff6600;
}

#sidebar {
    width: 250px;
    background-color: #ffffff;
    height: 100%;
    position: fixed;
    top: 0;
    left: -250px;
    transition: left 0.3s ease;
    margin-top: 60px;
    box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    z-index: 1040;
}

#sidebar ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

#sidebar ul li {
    padding: 15px 25px;
    border-bottom: 1px solid #f0f0f0;
    transition: background 0.3s;
}

#sidebar ul li:hover {
    background-color: #f8f9fa;
}

#sidebar ul li a {
    color: #333;
    text-decoration: none;
    font-weight: 500;
    display: block;
}

#sidebar.active {
    left: 0;
}

.main-content {
    margin-left: 0;
    padding: 90px 30px 30px; /* offset for fixed header */
    transition: margin-left 0.3s ease;
}

.main-content.active {
    margin-left: 250px;
}

/* Card layout for table */
.table-container {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    padding: 25px;
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
            <li><a href="dashboard.php">Semua Produk</a></li>
            <li><a href="upload.php">Tambah Produk</a></li>
            <li><a href="tambahadmin.php">Tambah Admin</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>

        <!-- Main Content -->
        <div class="main-content flex-fill" id="main-content">

            <div class="container-fluid">
                <div class="table-container">
                    <h2 class="mb-4">Daftar Produk</h2>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                // Koneksi ke database
                                $conn = new mysqli("localhost", "root", "", "db_nike");

                                // Cek koneksi
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Query untuk mengambil data artikel
                                $sql = "SELECT * FROM product";
                                $result = $conn->query($sql);

                                // Cek apakah data tersedia
                                if ($result->num_rows > 0) {
                                    // Loop untuk menampilkan data
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["id"] . "</td>";
                                        echo "<td><p class='fw-bold'>" . htmlspecialchars($row["name"]) . "</p></td>";
                                        echo "<td><span class='badge bg-success p-2 fs-6'> $" . htmlspecialchars($row["price"]) . "</span></td>";
                                        echo "<td><img src='../product/" . htmlspecialchars($row["image_path"]) . "' alt='Gambar Artikel' class='rounded' width='80'></td>";
                                        echo "<td class='text-center'>";
                                        echo "<a href='edit.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm me-2'>Edit</a>";
                                        echo "<a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus artikel ini?\");'>Hapus</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center text-muted'>Tidak ada data.</td></tr>";
                                }

                                // Tutup koneksi
                                $conn->close();
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            var mainContent = document.getElementById('main-content');
            
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
        });
    </script>
</body>
</html>
