<?php
include 'db.php';
include 'php/phantrang.php';
include 'php/kiemtrasession.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trang Chủ Đặt Tour</title>
    <link rel="stylesheet" href="css/csstrangchu.css">
    <script src="js/hienlichsu.js"></script>

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
                      include 'php/lichsutour.php';
                        ?>
                        <h3>Lịch sử đặt khách sạn</h3>
                        <?php
                       include 'php/lichsuks.php';
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
     include 'php/goitour.php';
    ?>
</div>
<div class="pagination">
   <?php   include 'php/phantrangtour.php';   ?>
</div>

<h2>Danh sách các khách sạn</h2>
<div class="hotel-grid">
    <?php
     include 'php/goihotel.php'; ?>

</div>
<div class="pagination">
<?php
     include 'php/phantrangks.php'; ?>

</div>

<footer>
    <p>&copy; 2024 Trang Chủ Đặt Tour</p>
</footer>
</body>
</html>