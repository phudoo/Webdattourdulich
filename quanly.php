<?php
include 'db.php';

// Kiểm tra xem người dùng đã đăng nhập với tài khoản admin chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['tentaikhoan']) || $_SESSION['tentaikhoan'] != 'admin') {
    header("Location: dangnhap.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Hệ Thống</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h2>Quản Lý Hệ Thống</h2>
  <nav>
    <ul>
      <li><a href="quanly_taikhoan.php">Quản Lý Tài Khoản</a></li>
      <li><a href="quanly_tour.php">Quản Lý Tour Du Lịch</a></li>
      <li><a href="quanly_khachsan.php">Quản Lý Khách Sạn</a></li>
    </ul>
  </nav>
</body>
</html>
