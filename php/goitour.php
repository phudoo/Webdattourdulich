<?php


function getTourHistory($conn, $tentaikhoan) {
    $sql = "SELECT * FROM dattour WHERE tentaikhoan = '" . $tentaikhoan . "'";
    $result = $conn->query($sql);
    return $result;
}
 
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