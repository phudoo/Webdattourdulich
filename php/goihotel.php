<?php

function getHotelHistory($conn, $tentaikhoan) {
    $sql = "SELECT * FROM datkhachsan WHERE tentaikhoan = '" . $tentaikhoan . "'";
    $result = $conn->query($sql);
    return $result;
}


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