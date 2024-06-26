<?php 
include 'db.php';

// Lấy các tham số tìm kiếm từ URL
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'tour';
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'asc';

$itemsPerPage = 4; // Số mục trên mỗi trang
$keyword = mysqli_real_escape_string($conn, $keyword); // Xử lý chuỗi truy vấn để tránh SQL Injection
$sort_order = ($sort_order === 'desc') ? 'DESC' : 'ASC'; // Sắp xếp theo thứ tự tăng dần hoặc giảm dần

// Xác định trang hiện tại
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage; // Tính toán vị trí bắt đầu cho truy vấn SQL

// Xây dựng truy vấn SQL dựa trên bộ lọc
if ($filter === 'tour') {
    $countSql = "SELECT COUNT(*) as total FROM tours WHERE tentour LIKE '%$keyword%' OR diadiem LIKE '%$keyword%'";
    $sql = "SELECT * FROM tours WHERE tentour LIKE '%$keyword%' OR diadiem LIKE '%$keyword%' ORDER BY giave $sort_order LIMIT $itemsPerPage OFFSET $offset";
} else {
    $countSql = "SELECT COUNT(*) as total FROM khachsan WHERE tenkhachsan LIKE '%$keyword%' OR diachi LIKE '%$keyword%'";
    $sql = "SELECT * FROM khachsan WHERE tenkhachsan LIKE '%$keyword%' OR diachi LIKE '%$keyword%' ORDER BY giaphong $sort_order LIMIT $itemsPerPage OFFSET $offset";
}

// Thực hiện truy vấn đếm số lượng kết quả
$countResult = mysqli_query($conn, $countSql);
$totalItems = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalItems / $itemsPerPage); // Tính tổng số trang

// Thực hiện truy vấn lấy kết quả tìm kiếm
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="css/csstrangchu.css">
    <style>
        .pagination a {
            margin: 0 5px;
            text-decoration: none;
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
           
            <form action="timkiem.php" method="GET">
                <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." required>
                <label><input type="radio" name="filter" value="tour" <?php echo ($filter === 'tour') ? 'checked' : ''; ?>> Tour</label>
                <label><input type="radio" name="filter" value="khachsan" <?php echo ($filter === 'khachsan') ? 'checked' : ''; ?>> Khách Sạn</label>
                <select name="sort_order">
                    <option value="asc" <?php echo ($sort_order === 'asc') ? 'selected' : ''; ?>>Giá từ thấp đến cao</option>
                    <option value="desc" <?php echo ($sort_order === 'desc') ? 'selected' : ''; ?>>Giá từ cao đến thấp</option>
                </select>
                <button type="submit">Tìm Kiếm</button>
            </form>
        </ul>
    </nav>
</header>

<h1>Kết quả tìm kiếm cho "<?php echo ($keyword); ?>"</h1>

<div class="result-grid">
    <?php
    // Kiểm tra nếu có kết quả tìm kiếm
    if (mysqli_num_rows($result) > 0) {
        // Lặp qua từng kết quả và hiển thị
        while ($row = mysqli_fetch_assoc($result)) {
            if ($filter === 'tour') {
                echo "<div class='tour-item'>";
                echo "<img src='images/TOUR/" . ($row["hinhanh"]) . "' alt='Hình Ảnh Tour' style='width: 150px; height: auto;'>";
                echo "<p><strong>Mã Tour:</strong> " . ($row["matour"]) . "</p>";
                echo "<p><strong>Tên Tour:</strong> " . ($row["tentour"]) . "</p>";
                echo "<p><strong>Địa Điểm:</strong> " . ($row["diadiem"]) . "</p>";
                echo "<p><strong>Thời Gian:</strong> " . ($row["thoigian"]) . "</p>";
                echo "<p><strong>Giá Vé:</strong> " . ($row["giave"]) . "</p>";
                echo '<p><a href="chitiettour.php?matour=' . ($row["matour"]) . '">Xem Chi Tiết</a></p>';
                echo "<button onclick=\"window.location.href='dattour.php?matour=" . ($row["matour"]) . "'\">Đặt Tour</button>";
                echo "</div>";
            } else {
                echo "<div class='hotel-item'>";
                echo "<img src='images/KS/" . ($row["hinhanh"]) . "' alt='Hình Ảnh Khách Sạn' style='width: 150px; height: auto;'>";
                echo "<p><strong>Tên Khách Sạn:</strong> " . ($row["tenkhachsan"]) . "</p>";
                echo "<p><strong>Địa Chỉ:</strong> " . ($row["diachi"]) . "</p>";
                echo "<p><strong>Loại Phòng:</strong> " . ($row["loaiphong"]) . "</p>";
                echo "<p><strong>Số Phòng:</strong> " . ($row["sophong"]) . "</p>";
                echo "<p><strong>Giá Phòng:</strong> " . ($row["giaphong"]) . "</p>";
                echo '<p><a href="chitietkhachsan.php?makhachsan=' . ($row["makhachsan"]) . '">Xem Chi Tiết</a></p>';
                echo "<button onclick=\"window.location.href='datkhachsan.php?makhachsan=" . ($row["makhachsan"]) . "'\">Đặt Phòng</button>";
                echo "</div>";
            }
        }
    } else {
        echo "<p>Không tìm thấy kết quả nào</p>";
    }
    ?>
</div>

<div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?keyword=<?php echo ($keyword); ?>&filter=<?php echo $filter; ?>&sort_order=<?php echo $sort_order; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

<footer>
    <p>&copy; 2024 Trang Chủ Đặt Tour</p>
</footer>
</body>
</html>
