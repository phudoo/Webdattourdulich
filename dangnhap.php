<?php

include 'db.php'; // Kết nối CSDL
include 'php/xldangnhap.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Đăng Nhập</title>
  <link rel="stylesheet" href="css/cssdangnhap.css">
</head>
<body>
  <h2>Đăng Nhập</h2>

  <form method="post" action="dangnhap.php">
    <label for="tentaikhoan">Tên Tài Khoản:</label><br>
    <input type="text" id="tentaikhoan" name="tentaikhoan"><br>
    <label for="matkhau">Mật Khẩu:</label><br>
    <input type="password" id="matkhau" name="matkhau"><br>
    <input type="submit" value="Đăng Nhập">
    <h4 >Bạn chưa có tài khoản? Vui lòng <a href="dangky.php"> Đăng Ký </a></h4>
  </form>
</body>
</html>
