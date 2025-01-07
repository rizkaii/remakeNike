<?php
// Memulai session
session_start();

// Hancurkan semua session yang ada
session_unset();
session_destroy();

// Redirect ke halaman login
header("Location: login/index.php");
exit();
?>
