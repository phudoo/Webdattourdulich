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
    
    if (mysqli_query($conn, $sql)) {
        echo "Xóa tour thành công!";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    echo "Không có mã tour để xóa.";
}

mysqli_close($conn);
header("Location: quanly.php");
exit();
?>
