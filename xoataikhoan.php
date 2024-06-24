<?php
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['tentaikhoan']) || $_SESSION['tentaikhoan'] != 'admin') {
    header("Location: dangnhap.php");
    exit();
}

if (isset($_GET['tentaikhoan'])) {
    $tentaikhoan = $_GET['tentaikhoan'];

    // Xóa tài khoản từ cơ sở dữ liệu
    $sql_delete = "DELETE FROM taikhoan WHERE tentaikhoan = '$tentaikhoan'";
    
    if (mysqli_query($conn, $sql_delete)) {
        echo "Xóa tài khoản thành công.";
    } else {
        echo "Có lỗi xảy ra khi xóa tài khoản: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: quanly_taikhoan.php");
    exit();
} else {
    echo "Không tìm thấy tài khoản để xóa.";
}
?>
