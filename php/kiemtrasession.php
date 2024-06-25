<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['tentaikhoan'])) {
    // If not logged in, redirect to login page
    header("Location: dangnhap.php");
    exit();
}
?>