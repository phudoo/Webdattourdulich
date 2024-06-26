<?php

function getHotelHistory($conn, $tentaikhoan) {
    $sql = "SELECT * FROM datkhachsan WHERE tentaikhoan = '" . $tentaikhoan . "'";
    $result = mysqli_query($conn, $sql); // Thực thi truy vấn SQL
    return $result; // Trả về kết quả của truy vấn
}

$sql = "SELECT * FROM khachsan LIMIT $itemsPerPage OFFSET $hotelOffset";
$result = mysqli_query($conn, $sql); // Thực thi truy vấn SQL

if (mysqli_num_rows($result) > 0) { // Kiểm tra nếu có dòng kết quả trả về
    while ($row = mysqli_fetch_assoc($result)) { // Lặp qua từng dòng kết quả
     
        echo "<div class='hotel-item'>";
        echo "<td><img src='images/KS/" . $row["hinhanh"] . "' alt='Hình Ảnh Khách Sạn' style='width: 150px; height: auto;'></td>";
        echo "<p><strong>Tên Khách Sạn:</strong> " . $row["tenkhachsan"] . "</p>";
        echo "<p><strong>Địa Chỉ:</strong> " . $row["diachi"] . "</p>";
        echo "<p><strong>Giá Phòng:</strong> " . $row["giaphong"] . "</p>";
        echo "<p><a href='chitietkhachsan.php?makhachsan=" . $row["makhachsan"] . "'>Xem Chi Tiết</a></p>";
        echo "<button> <a href='datkhachsan.php?makhachsan=" . $row["makhachsan"] . "' >Đặt Phòng</a></button>";
        echo "</div>";
    }
} else {
    echo "<p>Không có khách sạn nào</p>"; 
}

?>
