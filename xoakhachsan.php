<?php
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
    $sql_delete = "DELETE FROM khachsan WHERE makhachsan = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("s", $makhachsan);

    if ($stmt->execute()) {
        echo "Xóa khách sạn thành công.";
    } else {
        echo "Có lỗi xảy ra khi xóa khách sạn.";
    }

    $stmt->close();
    $conn->close();
    header("Location: quanly.php");
    exit();
} else {
    echo "Không tìm thấy khách sạn để xóa.";
}
?>
