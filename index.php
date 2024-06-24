<?php
include 'db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['tentaikhoan'])) {
    // If not logged in, redirect to login page
    header("Location: dangnhap.php");
    exit();
}

$itemsPerPage = 4;

// Calculate total pages for tours
$tourSql = "SELECT COUNT(*) as total FROM tours";
$tourResult = $conn->query($tourSql);
$totalTours = $tourResult->fetch_assoc()['total'];
$totalTourPages = ceil($totalTours / $itemsPerPage);
$currentTourPage = isset($_GET['tour_page']) ? (int)$_GET['tour_page'] : 1;
$tourOffset = ($currentTourPage - 1) * $itemsPerPage;

// Calculate total pages for hotels
$hotelSql = "SELECT COUNT(*) as total FROM khachsan";
$hotelResult = $conn->query($hotelSql);
$totalHotels = $hotelResult->fetch_assoc()['total'];
$totalHotelPages = ceil($totalHotels / $itemsPerPage);
$currentHotelPage = isset($_GET['hotel_page']) ? (int)$_GET['hotel_page'] : 1;
$hotelOffset = ($currentHotelPage - 1) * $itemsPerPage;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trang Chủ Đặt Tour</title>
    <link rel="stylesheet" href="csstrangchu.css">
    <script>
        function toggleBookingHistory() {
            document.querySelector('.booking-history').classList.toggle('show');
        }
    </script>
    <style>
        .booking-history { display: none; }
        .booking-history.show { display: block; }
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
            <div class="user-actions">
    <?php if (isset($_SESSION['tentaikhoan'])): ?>
        <div class="user-info">
            <label for="toggle-history" style="color:#333; cursor: pointer;">Xem Lịch Sử Đặt</label>
            <select onchange="location = this.value;">
                <option value="#">Xin chào, <?php echo $_SESSION['tentaikhoan']; ?></option>
                <option value="dangxuat.php">Đăng Xuất</option>
            </select>
        </div>
        <input type="checkbox" id="toggle-history">
        <div class="overlay"></div>
        <div class="booking-history">
        <button onclick="window.location.href='index.php'">Quay Về Trang Chủ</button>
                        <h3>Lịch sử đặt tour</h3>

                        <?php
                        $sql = "SELECT * FROM dattour WHERE tentaikhoan = '" . $_SESSION['tentaikhoan'] . "'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<p><strong>Tên Tour:</strong> " . $row["tentour"] . " - <strong>Ngày Bắt Đầu:</strong> " . $row["ngaybatdau"] . "</p>";
                            }
                        } else {
                            echo "<p>Không có lịch sử đặt tour</p>";
                        }
                        ?>
                        <h3>Lịch sử đặt khách sạn</h3>
                        <?php
                        $sql = "SELECT * FROM datkhachsan WHERE tentaikhoan = '" . $_SESSION['tentaikhoan'] . "'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<p><strong>Tên Khách Sạn:</strong> " . $row["tenkhachsan"] . " - <strong>Ngày Nhận Phòng:</strong> " . $row["ngaynhanphong"] . "</p>";
                            }
                        } else {
                            echo "<p>Không có lịch sử đặt khách sạn</p>";
                        }
                        ?>
                    </div>
                <?php else: ?>
                    <li><a href="dangky.php">Đăng Ký</a></li>
                    <li><a href="dangnhap.php">Đăng Nhập</a></li>
                <?php endif; ?>
            </div>
        </ul>
    </nav>
</header>

<h1>Chào mừng đến với Trang Đặt Tour Du Lịch</h1>

<h2>Danh sách các tour</h2>
<div class="tour-grid">
    <?php
    $sql = "SELECT * FROM tours LIMIT $itemsPerPage OFFSET $tourOffset";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='tour-item'>";
            echo "<td><img src='images/TOUR/" . $row["hinhanh"] . "' alt='Hình Ảnh Tour' style='width: 150px; height: auto;'>";
            echo "<p><strong>Mã Tour:</strong> " . $row["matour"] . "</p>";
            echo "<p><strong>Tên Tour:</strong> " . $row["tentour"] . "</p>";
            echo "<p><strong>Địa Điểm:</strong> " . $row["diadiem"] . "</p>";
            echo "<p><strong>Thời Gian:</strong> " . $row["thoigian"] . "</p>";
            echo "<p><strong>Giá Vé:</strong> " . $row["giave"] . "</p>";
            echo "<p><a href='chitiettour.php?matour=" . $row["matour"] . "'>Xem Chi Tiết</a></p>";
            echo "<button onclick=\"window.location.href='dattour.php?matour=" . $row["matour"] . "'\">Đặt Tour</button>";
            echo "</div>";
        }
    } else {
        echo "<p>Không có tour nào</p>";
    }
    ?>
</div>
<div class="pagination">
    <?php for ($i = 1; $i <= $totalTourPages; $i++): ?>
        <a href="?tour_page=<?php echo $i; ?><?php if (isset($currentHotelPage)) echo '&hotel_page=' . $currentHotelPage; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

<h2>Danh sách các khách sạn</h2>
<div class="hotel-grid">
    <?php
    $sql = "SELECT * FROM khachsan LIMIT $itemsPerPage OFFSET $hotelOffset";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='hotel-item'>";
            echo "<td><img src='images/KS/" . $row["hinhanh"] . "' alt='Hình Ảnh Khách Sạn' style='width: 150px; height: auto;'></td>";
            echo "<p><strong>Tên Khách Sạn:</strong> " . $row["tenkhachsan"] . "</p>";
            echo "<p><strong>Địa Chỉ:</strong> " . $row["diachi"] . "</p>";
            echo "<p><strong>Loại Phòng:</strong> " . $row["loaiphong"] . "</p>";
            echo "<p><strong>Số Phòng:</strong> " . $row["sophong"] . "</p>";
            echo "<p><strong>Giá Phòng:</strong> " . $row["giaphong"] . "</p>";
            echo "<p><a href='chitietkhachsan.php?makhachsan=" . $row["makhachsan"] . "'>Xem Chi Tiết</a></p>";
            echo "<button onclick=\"window.location.href='datkhachsan.php?makhachsan=" . $row["makhachsan"] . "'\">Đặt Phòng</button>";
            echo "</div>";
        }
    } else {
        echo "<p>Không có khách sạn nào</p>";
    }
    ?>
</div>
<div class="pagination">
    <?php for ($i = 1; $i <= $totalHotelPages; $i++): ?>
        <a href="?hotel_page=<?php echo $i; ?><?php if (isset($currentTourPage)) echo '&tour_page=' . $currentTourPage; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

<footer>
    <p>&copy; 2024 Trang Chủ Đặt Tour</p>
</footer>
</body>
</html>