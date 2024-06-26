<?php
include 'db.php'; // Đảm bảo rằng file db.php đã được bao gồm và kết nối đã được thiết lập

$sql = "SELECT * FROM tours";
$result = mysqli_query($conn, $sql); // Thực thi câu truy vấn và lấy kết quả

if (mysqli_num_rows($result) > 0) {
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<title>Danh Sách Tour</title>";
    echo "<link rel='stylesheet' href='css/styles.css'>";
    echo "</head>";
    echo "<body>";
    echo "<h1>Danh Sách Các Tour Du Lịch</h1>";
    echo "<table>";
    echo "<tr>";
    echo "<th></th>";
    echo "<th>Mã Tour</th>";
    echo "<th>Tên Tour</th>";
    echo "<th>Địa Điểm</th>";
    echo "<th>Thời Gian</th>";
    echo "<th>Giá Vé</th>";
    echo "<th>Đặt Tour</th>";
    echo "</tr>";

    // Lặp qua từng dòng dữ liệu và hiển thị ra HTML
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><img src='images/TOUR/" . $row["hinhanh"] . ".PNG' alt='Hình Ảnh Tour'></td>";
        echo "<td>" . $row["matour"] . "</td>";
        echo "<td>" . $row["tentour"] . "</td>";
        echo "<td>" . $row["diadiem"] . "</td>";
        echo "<td>" . $row["thoigian"] . "</td>";
        echo "<td>" . $row["giave"] . "</td>";
        echo "<td><a href='dattour.php?matour=" . $row["matour"] . "'>Đặt Tour</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</body>";
    echo "</html>";
} else {
    echo "<p>Không có tour nào</p>";
}

mysqli_close($conn); // Đóng kết nối sau khi hoàn thành công việc
?>
