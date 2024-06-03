<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["tentaikhoan"]) || empty($_POST["matkhau"])) {
        $_SESSION['login_message'] = "Vui lòng nhập đầy đủ tên tài khoản và mật khẩu.";
    } else {
        $tentaikhoan = $_POST["tentaikhoan"];
        $matkhau = $_POST["matkhau"];

        $stmt = $conn->prepare("SELECT * FROM taikhoan WHERE tentaikhoan=? AND matkhau=?");
        $stmt->bind_param("ss", $tentaikhoan, $matkhau);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['tentaikhoan'] = $tentaikhoan;
            if ($tentaikhoan === 'admin') {
                header("Location: quanly.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['login_message'] = "Sai tên tài khoản hoặc mật khẩu!";
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Đăng Nhập</title>
  <link rel="stylesheet" href="cssdkdn.css">
</head>
<body>
  <h2>Đăng Nhập</h2>
  <?php if(isset($_SESSION['login_message'])) { ?>
    <div class="message"><?php echo $_SESSION['login_message']; ?></div>
    <?php unset($_SESSION['login_message']); ?>
  <?php } ?>
  <form method="post" action="dangnhap.php">
    <label for="tentaikhoan">Tên Tài Khoản:</label><br>
    <input type="text" id="tentaikhoan" name="tentaikhoan"><br>
    <label for="matkhau">Mật Khẩu:</label><br>
    <input type="password" id="matkhau" name="matkhau"><br>
    <input type="submit" value="Đăng Nhập">
    <a >Bạn chưa có tài khoản? Vui lòng <a href="dangky.php"> Đăng Ký </a></a>
  </form>
</body>
</html>
