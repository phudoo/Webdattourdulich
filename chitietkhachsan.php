<?php
include 'db.php';

// Lấy mã khách sạn từ URL
if (isset($_GET['makhachsan'])) {
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
} elseif (isset($_GET['matour'])) {
    // Lấy mã tour từ URL
    $matour = $_GET['matour'];

    // Truy vấn để lấy thông tin chi tiết của tour
    $sql = "SELECT * FROM tours WHERE matour = '$matour'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Hiển thị thông tin chi tiết của tour
        $tentour = $row['tentour'];
        $diadiem = $row['diadiem'];
        $thoigian = $row['thoigian'];
        $giave = $row['giave'];
        $hinhanh = $row['hinhanh'];
    } else {
        // Nếu không có tour nào có mã tương ứng, hiển thị thông báo lỗi
        echo "Không tìm thấy tour!";
    }
} else {
    // Nếu không có mã khách sạn hoặc tour được truyền, hiển thị thông báo lỗi
    echo "Mã khách sạn hoặc tour không được cung cấp!";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Xem Chi Tiết</title>
  <link rel="stylesheet" href="csstrangchu.css">
  <style>
    .detail {
      text-align: center;
      margin: 50px auto;
      max-width: 600px;
    }

    .detail img {
      width: 100%;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    .detail p {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
<header>
    <nav>
      <ul>
        <li><a href="index.php">Trang Chủ</a></li>
        <li><a href="tours.php">Danh Sách Tour</a></li>
        <li><a href="khachsan.php">Khách Sạn</a></li>
        <li>
            <form action="timkiem.php" method="GET">
                <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." required>
                <label><input type="radio" name="filter" value="tour" checked> Tour</label>
                <label><input type="radio" name="filter" value="khachsan"> Khách Sạn</label>
                <select name="sort_order">
                    <option value="asc">Giá từ thấp đến cao</option>
                    <option value="desc">Giá từ cao đến thấp</option>
                </select>
                <button type="submit">Tìm Kiếm</button>
            </form>
        </li>
      </ul>
    </nav>
</header>

<?php if (isset($tenkhachsan)): ?>
<h1>Thông Tin Chi Tiết Khách Sạn</h1>
<div class="detail">
    <h2><?php echo $tenkhachsan; ?></h2>
    <img src="images/KS/<?php echo $hinhanh; ?>.PNG" alt="Hình Ảnh Khách Sạn">
    <p><strong>Địa Chỉ:</strong> <?php echo $diachi; ?></p>
    <p><strong>Số Phòng:</strong> <?php echo $sophong; ?></p>
    <p><strong>Giá Phòng:</strong> <?php echo $giaphong; ?></p>
    <button onclick="window.location.href='datkhachsan.php?makhachsan=<?php echo htmlspecialchars($makhachsan); ?>'">Đặt Phòng</button>
    <button onclick="window.location.href='index.php'">Quay Về Trang Chủ</button>
</div>

<?php elseif (isset($tentour)): ?>
<h1>Thông Tin Chi Tiết Tour</h1>
<div class="detail">
    <h2><?php echo $tentour; ?></h2>
    <img src="<?php echo $hinhanh; ?>" alt="Hình Ảnh Tour">
    <p><strong>Địa Điểm:</strong> <?php echo $diadiem; ?></p>
    <p><strong>Thời Gian:</strong> <?php echo $thoigian; ?></p>
    <p><strong>Giá Vé:</strong> <?php echo $giave; ?></p>
    <button onclick="window.location.href='dattour.php?matour=<?php echo htmlspecialchars($matour); ?>'">Đặt Tour</button>
    <button onclick="window.location.href='index.php'">Quay Về Trang Chủ</button>
</div>

<?php endif; ?>
</body>
</html>
