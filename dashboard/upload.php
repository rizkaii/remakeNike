
<?php
// Memulai session untuk memeriksa status login
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login/login.php");
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
        form {

    
    border-radius: 8px;
    width: 100%;

    margin-top: 70px;
}

/* Form Title */
h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

/* Input Fields */
label {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
    color: #555;
}

input[type="text"],
textarea,
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
}

textarea {
    resize: none;
    height: 200px;
    width: 100%;
}

/* Submit Button */
button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

button:hover {
    background-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 600px) {
    form {
        padding: 15px;
    }

    h2 {
        font-size: 20px;
    }

    button {
        font-size: 14px;
    }
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
    width: 20px;
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
            <li><a href="dashboard.php">Semua Product</a></li>
            <li><a href="upload.php">Tambah Product</a></li>
            <li><a href="tambahadmin.php">Tambah Admin</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>

        <!-- Main Content -->
        <div class="main-content flex-fill">

            <div class="container p-4">
                <form action="uploadProses.php" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="judul">Name:</label>
                        <input type="text" name="name" id="judul" required>
                    </div>
                    <div>
                        <label for="deskripsi">Price:</label>
                        <input name="price" id="deskripsi" required placeholder="ex : 150.00"></input>
                    </div>
                    <div>
                        <label for="gambar">Image:</label>
                        <input type="file" name="image" id="gambar" accept="image/*" required>
                    </div>
                    <button type="submit" name="submit">Simpan Product</button>
                </form>
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
