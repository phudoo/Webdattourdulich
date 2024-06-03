<?php
include 'db.php';

// Lấy mã tour từ URL
if (isset($_GET['matour'])) {
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
    // Nếu không có mã tour được truyền, hiển thị thông báo lỗi
    echo "Mã tour không được cung cấp!";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xem Chi Tiết Tour</title>
    <link rel="stylesheet" href="csstrangchu.css">
    <style>
        .tour-detail {
            text-align: center;
            margin: 50px auto;
            max-width: 600px;
        }

        .tour-detail img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .tour-detail p {
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
            <li><a href="dangky.php">Đăng Ký</a></li>
            <li><a href="dangnhap.php">Đăng Nhập</a></li>
        </ul>
    </nav>
</header>
<h1>Thông Tin Chi Tiết Tour</h1>
<div class="tour-detail">
    <?php
    if (isset($tentour)) {
        echo "<h2>$tentour</h2>";
        echo "<img src='$hinhanh' alt='Hình Ảnh Tour'>";
        echo "<p><strong>Địa Điểm:</strong> $diadiem</p>";
        echo "<p><strong>Thời Gian:</strong> $thoigian</p>";
        echo "<p><strong>Giá Vé:</strong> $giave</p>";
        echo "<button onclick=\"window.location.href='dattour.php?matour=" . htmlspecialchars($matour) . "'\">Đặt Tour</button>";
    }
    ?>
</div>
</body>
</html>
