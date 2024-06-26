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

// Lấy tài khoản từ URL
if (isset($_GET['tentaikhoan'])) {
    $tentaikhoan = $_GET['tentaikhoan'];
} else {
    echo "Không có tài khoản nào được chọn.";
    exit();
}

// Fetch the user data
$sql = "SELECT * FROM taikhoan WHERE tentaikhoan = '$tentaikhoan'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Không tìm thấy tài khoản.";
    exit();
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $sdt = $_POST["sdt"];
    $diachi = $_POST["diachi"];
    $matkhau = $_POST["matkhau"];

    // Cập nhật thông tin tài khoản vào cơ sở dữ liệu mà không mã hóa mật khẩu
    $sql = "UPDATE taikhoan SET email='$email', sdt='$sdt', diachi='$diachi', matkhau='$matkhau' WHERE tentaikhoan='$tentaikhoan'";

    if (mysqli_query($conn, $sql)) {
      echo "<script>
              alert('Cập nhật tài khoản thành công!');
              window.location.href = 'quanly_taikhoan.php';
            </script>";
      exit();
  } else {
      echo "Lỗi: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chỉnh Sửa Tài Khoản</title>
  <link rel="stylesheet" href="css/edit.css">
</head>
<body>
  <h2>Chỉnh Sửa Tài Khoản</h2>
  <form method="post" action="suataikhoan.php?tentaikhoan=<?php echo urlencode($tentaikhoan); ?>">
    <input type="hidden" name="tentaikhoan" value="<?php echo $row['tentaikhoan']; ?>">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>" required>
    <br>
    <label for="sdt">Số Điện Thoại:</label>
    <input type="text" name="sdt" id="sdt" value="<?php echo $row['sdt']; ?>" required>
    <br>
    <label for="diachi">Địa Chỉ:</label>
    <input type="text" name="diachi" id="diachi" value="<?php echo $row['diachi']; ?>" required>
    <br>
    <label for="matkhau">Mật Khẩu:</label>
    <input type="text" name="matkhau" id="matkhau" value="<?php echo $row['matkhau']; ?>" required>
    <br>
    <input type="submit" value="Cập nhật">
    <a href="quanly_taikhoan.php" class="btn-cancel">Hủy</a>
  </form>
</body>
</html>
