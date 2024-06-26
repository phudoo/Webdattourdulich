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
    <link rel="stylesheet" href="css/csstrangchu.css">
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
<h1>Thông Tin Chi Tiết Tour</h1>
<div class="tour-detail">
    <?php
    if (isset($tentour)) {
        echo "<div class='tour-item'>";
        echo "<td><img src='images/TOUR/" . $row["hinhanh"] . "' >";
        echo "<p><strong>Mã Tour:</strong> " . $row["matour"] . "</p>";
        echo "<p><strong>Tên Tour:</strong> " . $row["tentour"] . "</p>";
        echo "<p><strong>Địa Điểm:</strong> " . $row["diadiem"] . "</p>";
        echo "<p><strong>Thời Gian:</strong> " . $row["thoigian"] . "</p>";
        echo "<p><strong>Giá Vé:</strong> " . $row["giave"] . "</p>";
        echo "<button> <a href='dattour.php?matour=" . $row["matour"] . "' >Đặt Tour</a></button>";
        echo "</div>";
    }
    ?>
    <a href="index.php"> <button>Thoát </button> </a>
</div>
</body>
</html>
