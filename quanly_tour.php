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

// Lấy danh sách tour du lịch từ cơ sở dữ liệu
$sql_tours = "SELECT * FROM tours";
$result_tours = mysqli_query($conn, $sql_tours);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Tour Du Lịch</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h2>Quản Lý Tour Du Lịch</h2>
  <a href="themtour.php" class="btn-create">Tạo mới tour</a>
  <table>
    <tr>
      <th>Mã Tour</th>
      <th>Tên Tour</th>
      <th>Địa Điểm</th>
      <th>Thời Gian</th>
      <th>Giá Vé</th>
      <th>Hành Động</th>
    </tr>
    <?php
    if (mysqli_num_rows($result_tours) > 0) {
      while($row = mysqli_fetch_assoc($result_tours)) {
        echo "<tr>";
        echo "<td>" . $row["matour"] . "</td>";
        echo "<td>" . $row["tentour"] . "</td>";
        echo "<td>" . $row["diadiem"] . "</td>";
        echo "<td>" . $row["thoigian"] . "</td>";
        echo "<td>" . $row["giave"] . "</td>";
        echo '<td>
                <a href="suatour.php?matour=' . $row["matour"] . '">Chỉnh Sửa</a>
                <a href="xoatour.php?matour=' . $row["matour"] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa tour này?\');">Xóa</a>
              </td>';
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='6'>Không có tour nào.</td></tr>";
    }
    ?>
  </table>
</body>
</html>
