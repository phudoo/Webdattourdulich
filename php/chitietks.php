<?php
include 'db.php';

// Lấy mã khách sạn từ URL
if (isset($_GET['makhachsan'])) {
    $makhachsan = $_GET['makhachsan'];

    // Truy vấn để lấy thông tin chi tiết của khách sạn
    $sql = "SELECT * FROM khachsan WHERE makhachsan = '$makhachsan'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Hiển thị thông tin chi tiết của khách sạn
        $tenkhachsan = $row['tenkhachsan'];
        $diachi = $row['diachi'];
        $sophong = $row['sophong'];
        $giaphong = $row['giaphong'];
        $hinhanh = $row['hinhanh'];
    } else {
        // Nếu không có khách sạn nào có mã tương ứng, hiển thị thông báo lỗi
        echo "Không tìm thấy khách sạn!";
    }
} elseif (isset($_GET['matour'])) {
    // Lấy mã tour từ URL
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
    // Nếu không có mã khách sạn hoặc tour được truyền, hiển thị thông báo lỗi
    echo "Mã khách sạn hoặc tour không được cung cấp!";
}
$conn->close();
?>