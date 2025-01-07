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


/* Form Group */
form{
    margin-top: 70px;
    width: 80%;
    margin-left: 10%;
    margin-right: 10%;
}
.form-group {
    margin-bottom: 20px;
    text-align: left;

    
    
}

.form-group label {
    font-size: 1rem;
    color: #0f1126;
    margin-bottom: 5px;
    display: block;
    width: 70%;
}

.form-group input {
    width: 90%;
    padding: 10px 40px 10px 10px;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    outline: none;
    transition: border-color 0.3s ease;
}

.form-group input:focus {
    border-color: #4CAF50;
}

.form-group i {
    float: right;
    right: 10px;
    top: 90%;
    transform: translateY(-50%);
    color: #777;
    font-size: 1.2rem;
    position: absolute;
}

/* Login Button */
.btn-login {
    width: 90%;
    padding: 10px;
    font-size: 1rem;
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-login:hover {
    background-color: #3e8e41;
}

header {
    background-color: #333;
    color: white;
    padding: 10px 20px;
    display: flex;
    align-items: center;
   
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
            <li><a href="dashboard.php">Semua Product</a></li>
            <li><a href="upload.php">Tambah Product</a></li>
            <li><a href="tambahadmin.php">Tambah Admin</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>

        <!-- Main Content -->
        <div class="main-content flex-fill">
        <form action="tambahadminproses.php" method="POST" class="login-form">
                <div class="form-group">
                    <i class="bi bi-person"></i>
                    <label for="username">Name</label>
                    <input type="text" name="nama" placeholder="Name" required="">
                </div>
                <div class="form-group">
                    <i class="bi bi-lock"></i>
                    <label for="password">Username</label>
                    <input type="text" name="username" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <i class="bi bi-envelope"></i>
                    <label for="email">Password</label>
                    <input type="password" name="password" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn-login">Buat Akun</button>
            </form>

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
