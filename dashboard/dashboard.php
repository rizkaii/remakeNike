<?php
// Memulai session untuk memeriksa status login
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login/index.php.php");
    exit();
}

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
        <div class="main-content flex-fill">

            <div class="container p-4">
                <h2>Daftar Artikel</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
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
                                    echo "<td><p>" . htmlspecialchars($row["name"]) . "</p></td>";
                                    echo "<td><p> $". htmlspecialchars($row["price"]) . "</p></td>";
                                    echo "<td><img src='../product/" . htmlspecialchars($row["image_path"]) . "' alt='Gambar Artikel' width='100'></td>";
                                    echo "<td>";
                                    echo "<a href='edit.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a> ";
                                    echo "<br>";
                                    // echo "<a href='../galery/detail.php?id=" . $row["id"] . "' class='btn btn-info btn-sm'>Lihat</a> ";
                                    echo "<br>";
                                    echo "<a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus artikel ini?\");'>Hapus</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }

                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo "Tidak ada data.";
                            }

                            // Tutup koneksi
                            $conn->close();
                            ?>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>document.getElementById('menu-toggle').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    var main = document.querySelector('main');
    
    sidebar.classList.toggle('active');
    main.classList.toggle('active');
});</script>
</body>
</html>
