<?php
include 'db.php';
include 'quanly.php';

// Kiểm tra xem người dùng đã đăng nhập với tài khoản admin chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['tentaikhoan']) || $_SESSION['tentaikhoan'] != 'admin') {
    header("Location: dangnhap.php");
    exit();
}

// Thiết lập số mục hiển thị trên mỗi trang
$itemsPerPage = 5;

// Tính tổng số trang
$sql_total = "SELECT COUNT(*) as total FROM khachsan";
$result_total = mysqli_query($conn, $sql_total);
$totalRows = mysqli_fetch_assoc($result_total)['total'];
$totalPages = ceil($totalRows / $itemsPerPage);

// Lấy trang hiện tại từ URL
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $itemsPerPage;

// Lấy danh sách khách sạn từ cơ sở dữ liệu với phân trang
$sql_hotels = "SELECT * FROM khachsan LIMIT $offset, $itemsPerPage";
$result_hotels = mysqli_query($conn, $sql_hotels);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Khách Sạn</title>
  <link rel="stylesheet" href="css/quanly.css">
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
    if (mysqli_num_rows($result_hotels) > 0) {
      while($row = mysqli_fetch_assoc($result_hotels)) {
        echo "<tr>";
        echo "<td>" . $row["makhachsan"] . "</td>";
        echo "<td>" . $row["tenkhachsan"] . "</td>";
        echo "<td>" . $row["diachi"] . "</td>";
        echo "<td>" . $row["sophong"] . "</td>";
        echo "<td>" . $row["loaiphong"] . "</td>";
        echo "<td>" . $row["giaphong"] . "</td>";
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
  <div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <a href="?page=<?php echo $i; ?>"<?php if ($i == $current_page) echo ' class="active"'; ?>><?php echo $i; ?></a>
    <?php endfor; ?>
  </div>
</body>
</html>
