<?php
include 'db.php'; // Đảm bảo rằng file db.php đã được bao gồm và kết nối đã được thiết lập

$sql = "SELECT * FROM khachsan";
$result = mysqli_query($conn, $sql); // Thực thi câu truy vấn và lấy kết quả

if (mysqli_num_rows($result) > 0) {
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<title>Danh Sách Khách Sạn</title>";
    echo "<link rel='stylesheet' href='css/styles.css'>";
    echo "</head>";
    echo "<body>";
    echo "<h1>Danh Sách Các Khách Sạn</h1>";
    echo "<table>";
    echo "<tr>";
    echo "<th></th>";
    echo "<th>Mã Khách Sạn</th>";
    echo "<th>Tên Khách Sạn</th>";
    echo "<th>Địa Chỉ</th>";
    echo "<th>Số Phòng</th>";
    echo "<th>Giá Phòng</th>";
    echo "<th>Đặt Phòng</th>";
    echo "</tr>";

    // Lặp qua từng dòng dữ liệu và hiển thị ra HTML
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><img src='images/KS/" . $row["hinhanh"] . "' alt='Hình Ảnh Khách Sạn' style='width: 150px; height: auto;'></td>";
        echo "<td>" . $row["makhachsan"] . "</td>";
        echo "<td>" . $row["tenkhachsan"] . "</td>";
        echo "<td>" . $row["diachi"] . "</td>";
        echo "<td>" . $row["sophong"] . "</td>";
        echo "<td>" . $row["giaphong"] . "</td>";
        echo "<td><a href='datkhachsan.php?makhachsan=" . $row["makhachsan"] . "'>Đặt Phòng</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</body>";
    echo "</html>";
} else {
    echo "<p>Không có khách sạn nào</p>";
}

mysqli_close($conn); // Đóng kết nối sau khi hoàn thành công việc
?>
