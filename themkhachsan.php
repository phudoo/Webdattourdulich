<?php
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['tentaikhoan']) || $_SESSION['tentaikhoan'] != 'admin') {
    header("Location: dangnhap.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tenkhachsan'])) {
    $tenkhachsan = $_POST['tenkhachsan'];
    $diachi = $_POST['diachi'];
    $sophong = $_POST['sophong'];
    $loaiphong = $_POST['loaiphong'];
    $giaphong = $_POST['giaphong'];

    // Thực hiện thêm khách sạn vào cơ sở dữ liệu
    $sql = "INSERT INTO khachsan (tenkhachsan, diachi, sophong, loaiphong, giaphong) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $tenkhachsan, $diachi, $sophong, $loaiphong, $giaphong);

    if ($stmt->execute()) {
        echo "Thêm khách sạn thành công.";
    } else {
        echo "Có lỗi xảy ra khi thêm khách sạn: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thêm Mới Khách Sạn</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h2>Thêm Mới Khách Sạn</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="tenkhachsan">Tên Khách Sạn:</label>
    <input type="text" name="tenkhachsan" id="tenkhachsan" required>
    <br>
    <label for="diachi">Địa Chỉ:</label>
    <input type="text" name="diachi" id="diachi" required>
    <br>
    <label for="sophong">Số Phòng:</label>
    <input type="number" name="sophong" id="sophong" required>
    <br>
    <label for="loaiphong">Loại Phòng:</label>
    <select name="loaiphong" id="loaiphong" required>
        <option value="Đơn">Đơn</option>
        <option value="Đôi">Đôi</option>
    </select>
    <br>
    <label for="giaphong">Giá Phòng:</label>
    <input type="number" name="giaphong" id="giaphong" required>
    <br>
    <button type="submit">Thêm Khách Sạn</button>
  </form>
</body>
</html>
