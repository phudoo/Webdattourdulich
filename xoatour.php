<?php
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['tentaikhoan']) || $_SESSION['tentaikhoan'] != 'admin') {
    header("Location: dangnhap.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['matour'])) {
    $matour = $_GET['matour'];

    // Xóa tour du lịch từ cơ sở dữ liệu
    $sql_delete = "DELETE FROM tours WHERE matour=?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("s", $matour);

    if ($stmt->execute()) {
        echo "Xóa tour du lịch thành công.";
    } else {
        echo "Có lỗi xảy ra khi xóa tour du lịch.";
    }

    $stmt->close();
    $conn->close();
    header("Location: quanly.php");
    exit();
} else {
    echo "Không có mã tour được cung cấp để xóa.";
}
?>
