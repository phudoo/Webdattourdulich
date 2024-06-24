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
    <div class="container">
        <h2>Quản Lý Hệ Thống</h2>
        <nav>
            <ul>
                <li><a href="quanly_taikhoan.php">Quản Lý Tài Khoản</a></li>
                <li><a href="quanly_tour.php">Quản Lý Tour Du Lịch</a></li>
                <li><a href="quanly_khachsan.php">Quản Lý Khách Sạn</a></li>
                <li class="dropdown">
                    <select onchange="location = this.value;">
                        <option value="#">Xin chào, <?php echo $_SESSION['tentaikhoan']; ?></option>
                        <option value="dangxuat.php">Đăng Xuất</option>
                    </select>
                </li>
            </ul>
        </nav>
    </div>
</body>
</html>
<style>
  /* Global styles */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f2f5;
    color: #333;
}

/* Container styles */
.container {
    width: 80%;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Heading styles */
h2 {
    text-align: center;
    color: #007bff;
    margin-bottom: 30px;
}

/* Navigation styles */
nav {
    text-align: center;
}

nav ul {
    list-style: none;
    padding: 0;
}

nav ul li {
    display: inline;
    margin: 0 10px;
    position: relative;
}

nav ul li a {
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
    padding: 10px 20px;
    border: 2px solid #007bff;
    border-radius: 4px;
    transition: all 0.3s ease;
}

nav ul li a:hover {
    background-color: #007bff;
    color: #fff;
}

nav ul li.dropdown {
    display: inline-block;
    margin-left: 20px;
}

nav ul li select {
    padding: 10px 20px;
    font-weight: bold;
    border: 2px solid #007bff;
    border-radius: 4px;
    background: none;
    cursor: pointer;
    color: #007bff;
    transition: all 0.3s ease;
}

nav ul li select:hover {
    background-color: #007bff;
    color: #fff;
}

/* Responsive design */
@media (max-width: 768px) {
    .container {
        width: 90%;
        padding: 10px;
    }

    nav ul li {
        display: block;
        margin: 10px 0;
    }

    nav ul li a,
    nav ul li select {
        display: block;
        width: 100%;
    }
}

</style>