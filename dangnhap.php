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
    <h4 >Bạn chưa có tài khoản? Vui lòng <a href="dangky.php"> Đăng Ký </a></h4>
  </form>
</body>
</html>
<style>
  /* Reset some default browser styles */
body, html {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-color: #f0f0f0; /* Light grey background */
}

/* Container for form */
form {
  max-width: 400px;
  margin: 20px auto;
  padding: 20px;
  background-color: #ffffff; /* White background */
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Headings */
h2 {
  color: #007bff; /* Blue heading */
  text-align: center;
}

/* Input fields */
input[type=text], input[type=password], input[type=email] {
  width: calc(100% - 20px);
  padding: 10px;
  margin: 5px 0;
  border: 1px solid #ddd;
  border-radius: 3px;
}

/* Submit button */
input[type=submit] {
  width: 100%;
  padding: 10px;
  background-color: #007bff; /* Blue button */
  border: none;
  color: #fff;
  cursor: pointer;
  border-radius: 3px;
}

input[type=submit]:hover {
  background-color: #0056b3; /* Darker blue on hover */
}

/* Links */
a {
  color: #007bff; /* Blue links */
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

/* Message box */
.message {
  padding: 10px;
  margin: 10px 0;
  background-color: #f0f0f0; /* Light grey background for messages */
  border: 1px solid #ddd;
  border-radius: 3px;
}

</style>