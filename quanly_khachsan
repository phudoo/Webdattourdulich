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

// Lấy danh sách khách sạn từ cơ sở dữ liệu
$sql_hotels = "SELECT * FROM khachsan";
$result_hotels = $conn->query($sql_hotels);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Khách Sạn</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h2>Quản Lý Khách Sạn</h2>
  <a href="themkhachsan.php" class="btn-create">Tạo mới khách sạn</a>
  <table>
    <tr>
      <th>Mã Khách Sạn</th>
      <th>Tên Khách Sạn</th>
      <th>Địa Chỉ</th>
      <th>Số Phòng</th>
      <th>Loại Phòng</th>
      <th>Giá Phòng</th>
      <th>Hành Động</th>
    </tr>
    <?php
    if ($result_hotels->num_rows > 0) {
      while($row = $result_hotels->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["makhachsan"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["tenkhachsan"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["diachi"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["sophong"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["loaiphong"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["giaphong"]) . "</td>";
        echo '<td>
                <a href="suakhachsan.php?makhachsan=' . $row["makhachsan"] . '">Chỉnh Sửa</a>
                <a href="xoakhachsan.php?makhachsan=' . $row["makhachsan"] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa khách sạn này?\');">Xóa</a>
              </td>';
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='6'>Không có khách sạn nào.</td></tr>";
    }
    ?>
  </table>
</body>
</html>
