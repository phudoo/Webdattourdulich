<?php
/* include lệnh chèn nội dung của một tệp khác vào tệp hiện tại*/
include 'db.php';
include 'php/phantrang.php';
include 'php/kiemtrasession.php';
?>
<!-- /* khai báo đây là tài liệu html */ -->
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trang Chủ Đặt Tour</title>
    <link rel="stylesheet" href="css/trangchu.css">
</head>
<body>
<header>
      <nav>  <!-- Thanh điều hướng  -->
        <ul>
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="tours.php">Danh Sách Tour</a></li>
            <li><a href="khachsan.php">Khách Sạn</a></li>
            <li>
                <form action="timkiem.php" method="GET"> 
                    <!-- URL cho trang trên máy chủ sẽ nhận thông tin trong biểu mẫu khi nó được gửi -->
                        <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." required>
                    <label>
                        <input type="radio" name="filter" value="tour" checked> Tour
                    </label>
                    <label>
                        <input type="radio" name="filter" value="khachsan"> Khách Sạn
                    </label>
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
              <label for="toggle-history" >Xem Lịch Sử Đặt</label>
                 <input type="checkbox" id="toggle-history"> 
                    <div class="booking-history">
                       <a href="index.php"> <button>Thoát </button> </a>
                        <h3>Lịch sử đặt tour</h3>
                        <?php
                          include 'php/lichsutour.php';
                        ?>
                          <h3>Lịch sử đặt khách sạn</h3>
                        <?php
                          include 'php/lichsuks.php';
                        ?>
                    </div>

                    <button>Xin chào, <?php echo $_SESSION['tentaikhoan']; ?> </button>
                    <button><a  href="dangxuat.php" >Đăng Xuất</a> </button>
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