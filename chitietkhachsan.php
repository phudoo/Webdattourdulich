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
        // Lưu thông tin chi tiết của khách sạn
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
    <title>Thông Tin Chi Tiết Khách Sạn</title>
    <link rel="stylesheet" href="css/csstrangchu.css">
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

<h1>Thông Tin Chi Tiết Khách Sạn</h1>
<div class="hotel-detail">
    <?php
    if (isset($tenkhachsan)) {
        echo "<div class='hotel-item'>";
        echo "<img src='images/KS/" . $row["hinhanh"] . "' >";
        echo "<p><strong>Mã Khách Sạn:</strong> " . $row["makhachsan"] . "</p>";
        echo "<p><strong>Tên Khách Sạn:</strong> " . $row["tenkhachsan"] . "</p>";
        echo "<p><strong>Địa Chỉ:</strong> " . $row["diachi"] . "</p>";
        echo "<p><strong>Số Phòng:</strong> " . $row["sophong"] . "</p>";
        echo "<p><strong>Giá Phòng:</strong> " . $row["giaphong"] . "</p>";
        echo "<button><a href='datkhachsan.php?makhachsan=" . $row["makhachsan"] . "'>Đặt Phòng</a></button>";
        echo "</div>";
    } else {
        // Nếu không có thông tin khách sạn, hiển thị thông báo lỗi
        echo "<p>Không tìm thấy thông tin khách sạn!</p>";
    }
    ?>
     <a href="index.php"> <button>Thoát </button> </a>
</div>

</body>
</html>
