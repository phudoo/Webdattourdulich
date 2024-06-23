<?php
// Kết nối đến cơ sở dữ liệu
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['tentaikhoan'])) {
    header("Location: dangnhap.php");
    exit();
}

$tentaikhoan = $_SESSION['tentaikhoan'];

// Fetch the user data
$sql = "SELECT * FROM taikhoan WHERE tentaikhoan = '$tentaikhoan'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Không tìm thấy tài khoản.";
    exit();
}

$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $sdt = $_POST["sdt"];
    $diachi = $_POST["diachi"];
    $matkhau = $_POST["matkhau"];

    // Cập nhật thông tin tài khoản vào cơ sở dữ liệu mà không mã hóa mật khẩu
    $sql = "UPDATE taikhoan SET email=?, sdt=?, diachi=?, matkhau=? WHERE tentaikhoan=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $email, $sdt, $diachi, $matkhau, $tentaikhoan);

    if ($stmt->execute()) {
        echo "Cập nhật tài khoản thành công!";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chỉnh Sửa Tài Khoản</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h2>Chỉnh Sửa Tài Khoản</h2>
  <form method="post" action="suataikhoan.php">
    <input type="hidden" name="tentaikhoan" value="<?php echo htmlspecialchars($row['tentaikhoan']); ?>">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
    <br>
    <label for="sdt">Số Điện Thoại:</label>
    <input type="text" name="sdt" id="sdt" value="<?php echo htmlspecialchars($row['sdt']); ?>" required>
    <br>
    <label for="diachi">Địa Chỉ:</label>
    <input type="text" name="diachi" id="diachi" value="<?php echo htmlspecialchars($row['diachi']); ?>" required>
    <br>
    <label for="matkhau">Mật Khẩu:</label>
    <input type="text" name="matkhau" id="matkhau" value="<?php echo htmlspecialchars($row['matkhau']); ?>" required>
    <br>
    <input type="submit" value="Cập Nhật">
  </form>
</body>
</html>
