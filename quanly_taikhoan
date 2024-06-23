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
$result_accounts = $conn->query($sql_accounts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Tài Khoản</title>
  <link rel="stylesheet" href="styles.css">
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
    if ($result_accounts->num_rows > 0) {
      while($row = $result_accounts->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["tentaikhoan"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["sdt"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["diachi"]) . "</td>";
        echo '<td>
                <a href="suataikhoan.php?tentaikhoan=' . $row["tentaikhoan"] . '">Chỉnh Sửa</a>
                <a href="xoataikhoan.php?tentaikhoan=' . $row["tentaikhoan"] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa tài khoản này?\');">Xóa</a>
              </td>';
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='4'>Không có tài khoản nào.</td></tr>";
    }
    ?>
  </table>
</body>
</html>
