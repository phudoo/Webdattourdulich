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
$sql_total = "SELECT COUNT(*) as total FROM tours";
$result_total = mysqli_query($conn, $sql_total);
$totalRows = mysqli_fetch_assoc($result_total)['total'];
$totalPages = ceil($totalRows / $itemsPerPage);

// Lấy trang hiện tại từ URL
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $itemsPerPage;

// Lấy danh sách tour du lịch từ cơ sở dữ liệu với phân trang
$sql_tours = "SELECT * FROM tours LIMIT $offset, $itemsPerPage";
$result_tours = mysqli_query($conn, $sql_tours);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Tour Du Lịch</title>
  <link rel="stylesheet" href="css/quanly.css">
</head>
<body>
  <h2>Quản Lý Tour Du Lịch</h2>
  <a href="themtour.php" class="btn-create">Tạo mới tour</a>
  <table>
    <tr>
      <th>Mã Tour</th>
      <th>Tên Tour</th>
      <th>Địa Điểm</th>
      <th>Thời Gian</nh>
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
  <div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <a href="?page=<?php echo $i; ?>"<?php if ($i == $current_page) echo ' class="active"'; ?>><?php echo $i; ?></a>
    <?php endfor; ?>
  </div>
</body>
</html>
