<?php

// Lấy mã tour từ URL
if (isset($_GET['matour'])) {
    $matour = $_GET['matour'];
    
    // Truy vấn để lấy thông tin chi tiết của tour
    $sql = "SELECT * FROM tours WHERE matour = '$matour'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Hiển thị thông tin chi tiết của tour
        $tentour = $row['tentour'];
        $diadiem = $row['diadiem'];
        $thoigian = $row['thoigian'];
        $giave = $row['giave'];
        $hinhanh = $row['hinhanh'];
    } else {
        // Nếu không có tour nào có mã tương ứng, hiển thị thông báo lỗi
        echo "Không tìm thấy tour!";
    }
} else {
    // Nếu không có mã tour được truyền, hiển thị thông báo lỗi
    echo "Mã tour không được cung cấp!";
}
$conn->close();
?>