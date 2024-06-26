<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Thông tin kết nối đến cơ sở dữ liệu MySQL
$servername = "localhost";  // Tên máy chủ MySQL
$username = "root";         // Tên người dùng MySQL
$password = "";             // Mật khẩu MySQL
$dbname = "dbdulich";        // Tên cơ sở dữ liệu MySQL

// Tạo kết nối đến cơ sở dữ liệu MySQL
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối đến cơ sở dữ liệu
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
