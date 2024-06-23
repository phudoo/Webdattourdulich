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

if (isset($_GET['matour'])) {
    $matour = $_GET['matour'];

    // Xóa tour từ cơ sở dữ liệu
    $sql = "DELETE FROM tours WHERE matour = '$matour'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Xóa tour thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Không có mã tour để xóa.";
}

$conn->close();
header("Location: quanly.php");
    exit();
?>
