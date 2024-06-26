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
$sql_total = "SELECT COUNT(*) as total FROM taikhoan";
$result_total = mysqli_query($conn, $sql_total);
$totalRows = mysqli_fetch_assoc($result_total)['total'];
$totalPages = ceil($totalRows / $itemsPerPage);

// Lấy trang hiện tại từ URL
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $itemsPerPage;

// Lấy danh sách tài khoản từ cơ sở dữ liệu với phân trang
$sql_accounts = "SELECT * FROM taikhoan LIMIT $offset, $itemsPerPage";
$result_accounts = mysqli_query($conn, $sql_accounts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Tài Khoản</title>
  <link rel="stylesheet" href="css/quanly.css">
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
  <div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <a href="?page=<?php echo $i; ?>"<?php if ($i == $current_page) echo ' class="active"'; ?>><?php echo $i; ?></a>
    <?php endfor; ?>
  </div>
</body>
</html>
