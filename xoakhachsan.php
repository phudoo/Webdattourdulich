<?php
// Kết nối đến cơ sở dữ liệu
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['tentaikhoan']) || $_SESSION['tentaikhoan'] != 'admin') {
    header("Location: dangnhap.php");
    exit();
}

if (isset($_GET['makhachsan'])) {
    $makhachsan = $_GET['makhachsan'];

    // Xóa khách sạn từ cơ sở dữ liệu
    $sql = "DELETE FROM khachsan WHERE makhachsan = '$makhachsan'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Xóa khách sạn thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Không có mã khách sạn để xóa.";
}

$conn->close();
header("Location: quanly.php");
    exit();
?>
