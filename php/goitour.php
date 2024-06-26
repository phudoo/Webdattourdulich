<?php

function getTourHistory($conn, $tentaikhoan) {
    $sql = "SELECT * FROM dattour WHERE tentaikhoan = '" . $tentaikhoan . "'";
    $result = mysqli_query($conn, $sql); // Thực thi truy vấn SQL
    return $result; // Trả về kết quả của truy vấn
}

$sql = "SELECT * FROM tours LIMIT $itemsPerPage OFFSET $tourOffset";
$result = mysqli_query($conn, $sql); // Thực thi truy vấn SQL

if (mysqli_num_rows($result) > 0) { // Kiểm tra nếu có dòng kết quả trả về
    while($row = mysqli_fetch_assoc($result)) { // Lặp qua từng dòng kết quả
   
        echo "<div class='tour-item'>";
        echo "<td><img src='images/TOUR/" . $row["hinhanh"] . "' alt='Hình Ảnh Tour' style='width: 150px; height: auto;'>";
        echo "<p><strong>Mã Tour:</strong> " . $row["matour"] . "</p>";
        echo "<p><strong>Tên Tour:</strong> " . $row["tentour"] . "</p>";
        echo "<p><strong>Địa Điểm:</strong> " . $row["diadiem"] . "</p>";
        echo "<p><strong>Thời Gian:</strong> " . $row["thoigian"] . "</p>";
        echo "<p><strong>Giá Vé:</strong> " . $row["giave"] . "</p>";
        echo "<p><a href='chitiettour.php?matour=" . $row["matour"] . "'>Xem Chi Tiết</a></p>";
        echo "<button> <a href='dattour.php?matour=" . $row["matour"] . "' >Đặt Tour</a></button>";
        echo "</div>";
    }
} else {
    echo "<p>Không có tour nào</p>";
}

?>
