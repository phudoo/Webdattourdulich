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

// Lấy danh sách tài khoản từ cơ sở dữ liệu
$sql_accounts = "SELECT * FROM taikhoan";
$result_accounts = mysqli_query($conn, $sql_accounts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Tài Khoản</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h2>Quản Lý Tài Khoản</h2>
  <table>
    <tr>
      <th>Tên Tài Khoản</th>
      <th>Email</th>
      <th>Số Điện Thoại</th>
      <th>Địa Chỉ</th>
      <th>Hành Động</th>
    </tr>
    <?php
    if (mysqli_num_rows($result_accounts) > 0) {
      while($row = mysqli_fetch_assoc($result_accounts)) {
        echo "<tr>";
        echo "<td>" . $row["tentaikhoan"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["sdt"] . "</td>";
        echo "<td>" . $row["diachi"] . "</td>";
        echo '<td>
                <a href="suataikhoan.php?tentaikhoan=' . $row["tentaikhoan"] . '">Chỉnh Sửa</a>
                <a href="xoataikhoan.php?tentaikhoan=' . $row["tentaikhoan"] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa tài khoản này?\');">Xóa</a>
              </td>';
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='5'>Không có tài khoản nào.</td></tr>";
    }
    ?>
  </table>
</body>
</html>
