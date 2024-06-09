<?php
include 'db.php';

// Lấy mã khách sạn từ URL
if(isset($_GET['makhachsan'])) {
    $makhachsan = $_GET['makhachsan'];
    
    // Truy vấn để lấy thông tin chi tiết của khách sạn
    $sql = "SELECT * FROM khachsan WHERE makhachsan = '$makhachsan'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Hiển thị thông tin chi tiết của khách sạn
        $tenkhachsan = $row['tenkhachsan'];
        $diachi = $row['diachi'];
        $sophong = $row['sophong'];
        $giaphong = $row['giaphong'];
        $hinhanh = $row['hinhanh'];
    } else {
        // Nếu không có khách sạn nào có mã tương ứng, hiển thị thông báo lỗi
        echo "Không tìm thấy khách sạn!";
    }
} else {
    // Nếu không có mã khách sạn được truyền, hiển thị thông báo lỗi
    echo "Mã khách sạn không được cung cấp!";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Xem Chi Tiết Khách Sạn</title>
  <link rel="stylesheet" href="csstrangchu.css">
  <style>
    .hotel-detail {
      text-align: center;
      margin: 50px auto;
      max-width: 600px;
    }

    .hotel-detail img {
      width: 100%;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    .hotel-detail p {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
<header>
    <nav>
      <ul>
        <li><a href="index.php">Trang Chủ</a></li>
        <li><a href="khachsan.php">Danh Sách Khách Sạn</a></li>
        <li><a href="dangky.php">Đăng Ký</a></li>
        <li><a href="dangnhap.php">Đăng Nhập</a></li>
      </ul>
    </nav>
</header>
<h1>Thông Tin Chi Tiết Khách Sạn</h1>
<div class="hotel-detail">
    <?php
    if(isset($tenkhachsan)) {
        echo "<h2>$tenkhachsan</h2>";
        echo "<td><img src='images/KS/" . $row["hinhanh"] . ".PNG' alt='Hình Ảnh Khách Sạn'>";
        echo "<p><strong>Địa Chỉ:</strong> $diachi</p>";
        echo "<p><strong>Số Phòng:</strong> $sophong</p>";
        echo "<p><strong>Giá Phòng:</strong> $giaphong</p>";
        echo "<button onclick='datPhong(" . htmlspecialchars($row["makhachsan"]) . ")'>Đặt Phòng</button>";
    }
    ?>
</div>
</body>
</html>
