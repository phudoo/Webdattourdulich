<?php
include 'db.php';

// Kiểm tra xem người dùng đã đăng nhập với tài khoản admin chưa
// Nếu không, chuyển hướng đến trang đăng nhập
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

// Lấy danh sách tour du lịch từ cơ sở dữ liệu
$sql_tours = "SELECT * FROM tours";
$result_tours = $conn->query($sql_tours);


// Lấy danh sách khách sạn từ cơ sở dữ liệu
$sql_hotels = "SELECT * FROM khachsan";
$result_hotels = $conn->query($sql_hotels);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Tài Khoản và Tour Du Lịch</title>
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
              </td>'; // Thêm các nút Chỉnh Sửa và Xóa
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='4'>Không có tài khoản nào.</td></tr>";
    }
    ?>
  </table>

  <h2>Quản Lý Tour Du Lịch</h2>
  <!-- Thêm nút "Tạo mới tour" -->
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
    if ($result_tours->num_rows > 0) {
      while($row = $result_tours->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["matour"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["tentour"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["diadiem"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["thoigian"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["giave"]) . "</td>";
        echo '<td>
                <a href="suatour.php?matour=' . $row["matour"] . '">Chỉnh Sửa</a>
                <a href="xoatour.php?matour=' . $row["matour"] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa tour này?\');">Xóa</a>
              </td>'; // Thêm các nút Chỉnh Sửa và Xóa
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='5'>Không có tour nào.</td></tr>";
    }
    ?>
  </table>


  <h2>Quản Lý Khách Sạn</h2>
  <!-- Thêm nút "Tạo mới khách sạn" -->
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
              </td>'; // Thêm các nút Chỉnh Sửa và Xóa
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='6'>Không có khách sạn nào.</td></tr>";
  }
  ?>
</table>

</body>
</html>
