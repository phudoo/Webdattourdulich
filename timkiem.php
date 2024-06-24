<?php
include 'db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'tour';
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'asc';

$itemsPerPage = 4;
$keyword = $conn->real_escape_string($keyword);
$sort_order = ($sort_order === 'desc') ? 'DESC' : 'ASC';

// Determine the current page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

if ($filter === 'tour') {
    $countSql = "SELECT COUNT(*) as total FROM tours WHERE tentour LIKE '%$keyword%' OR diadiem LIKE '%$keyword%'";
    $sql = "SELECT * FROM tours WHERE tentour LIKE '%$keyword%' OR diadiem LIKE '%$keyword%' ORDER BY giave $sort_order LIMIT $itemsPerPage OFFSET $offset";
} else {
    $countSql = "SELECT COUNT(*) as total FROM khachsan WHERE tenkhachsan LIKE '%$keyword%' OR diachi LIKE '%$keyword%'";
    $sql = "SELECT * FROM khachsan WHERE tenkhachsan LIKE '%$keyword%' OR diachi LIKE '%$keyword%' ORDER BY giaphong $sort_order LIMIT $itemsPerPage OFFSET $offset";
}

$countResult = $conn->query($countSql);
$totalItems = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

$result = $conn->query($sql);
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

<h1>Kết quả tìm kiếm cho "<?php echo htmlspecialchars($keyword); ?>"</h1>

<div class="result-grid">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($filter === 'tour') {
                echo "<div class='tour-item'>";
                echo "<img class='avatar' src='" . $row["hinhanh"] . "' alt='Hình Ảnh Tour' style='width: 150px; height: auto;'>";
                echo "<p><strong>Mã Tour:</strong> " . $row["matour"] . "</p>";
                echo "<p><strong>Tên Tour:</strong> " . $row["tentour"] . "</p>";
                echo "<p><strong>Địa Điểm:</strong> " . $row["diadiem"] . "</p>";
                echo "<p><strong>Thời Gian:</strong> " . $row["thoigian"] . "</p>";
                echo "<p><strong>Giá Vé:</strong> " . $row["giave"] . "</p>";
                echo '<p><a href="chitiettour.php?matour=' . $row["matour"] . '">Xem Chi Tiết</a></p>';
                echo "<button onclick=\"window.location.href='dattour.php?matour=" . $row["matour"] . "'\">Đặt Tour</button>";
                echo "</div>";
            } else {
                echo "<div class='hotel-item'>";
                echo "<img class='avatar' src='" . $row["hinhanh"] . "' alt='Hình Ảnh Khách Sạn' style='width: 150px; height: auto;'>";
                echo "<p><strong>Tên Khách Sạn:</strong> " . $row["tenkhachsan"] . "</p>";
                echo "<p><strong>Địa Chỉ:</strong> " . $row["diachi"] . "</p>";
                echo "<p><strong>Loại Phòng:</strong> " . $row["loaiphong"] . "</p>";
                echo "<p><strong>Số Phòng:</strong> " . $row["sophong"] . "</p>";
                echo "<p><strong>Giá Phòng:</strong> " . $row["giaphong"] . "</p>";
                echo '<p><a href="chitietkhachsan.php?makhachsan=' . $row["makhachsan"] . '">Xem Chi Tiết</a></p>';
                echo "<button onclick=\"window.location.href='datkhachsan.php?makhachsan=" . $row["makhachsan"] . "'\">Đặt Phòng</button>";
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
        <a href="?keyword=<?php echo urlencode($keyword); ?>&filter=<?php echo $filter; ?>&sort_order=<?php echo $sort_order; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

<footer>
    <p>&copy; 2024 Trang Chủ Đặt Tour</p>
</footer>
</body>
</html>
