<?php
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
} 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Kiểm tra các trường dữ liệu không được bỏ trống
  if (empty($_POST["tentaikhoan"]) || empty($_POST["matkhau"]) || empty($_POST["email"]) || empty($_POST["sdt"]) || empty($_POST["diachi"])) {
    $_SESSION['register_message'] = "Vui lòng điền đầy đủ thông tin.";
  } else {
    $tentaikhoan = $_POST["tentaikhoan"];
    $matkhau = $_POST["matkhau"];
    $email = $_POST["email"];
    $sdt = $_POST["sdt"];
    $diachi = $_POST["diachi"];

    // Kiểm tra độ dài của tên tài khoản và mật khẩu
    if (strlen($tentaikhoan) < 6 || strlen($tentaikhoan) > 20) {
      $_SESSION['register_message'] = "Tên tài khoản phải có độ dài từ 6 đến 20 ký tự.";
    } elseif (strlen($matkhau) < 6 || strlen($matkhau) > 20) {
      $_SESSION['register_message'] = "Mật khẩu phải có độ dài từ 6 đến 20 ký tự.";
    } else {
      // Kiểm tra xem tên tài khoản đã tồn tại chưa
      $sql_check = "SELECT * FROM taikhoan WHERE tentaikhoan='$tentaikhoan'";
      $result_check = $conn->query($sql_check);

      if ($result_check->num_rows > 0) {
        // Nếu tên tài khoản đã tồn tại, hiển thị thông báo lỗi
        $_SESSION['register_message'] = "Tên tài khoản đã tồn tại. Vui lòng chọn tên tài khoản khác.";
      } else {
        // Nếu tên tài khoản chưa tồn tại và đạt điều kiện, chèn dữ liệu mới
        $sql = "INSERT INTO taikhoan (tentaikhoan, matkhau, email, sdt, diachi) VALUES ('$tentaikhoan', '$matkhau', '$email', '$sdt', '$diachi')";

        if ($conn->query($sql) === TRUE) {
          // Lưu thông báo đăng ký thành công vào session
          $_SESSION['register_message'] = "Đăng ký tài khoản thành công!";
          // Chuyển hướng đến trang đăng nhập sau khi đăng ký thành công
          header("Location: dangnhap.php");
          exit();
        } else {
          echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
      }
    }
  }
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Đăng Ký Tài Khoản</title>
</head>
<body>
  <h2>Đăng Ký Tài Khoản</h2>
  <!-- Hiển thị thông báo đăng ký nếu có -->
  <?php if(isset($_SESSION['register_message'])) { ?>
    <div class="message"><?php echo $_SESSION['register_message']; ?></div>
    <?php unset($_SESSION['register_message']); ?>
  <?php } ?>
  <form method="post" action="dangky.php">
    <label for="tentaikhoan">Tên Tài Khoản:</label><br>
    <input type="text" id="tentaikhoan" name="tentaikhoan" maxlength="20" minlength="6" required><br>
    <label for="matkhau">Mật Khẩu:</label><br>
    <input type="password" id="matkhau" name="matkhau" maxlength="20" minlength="6" required><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="sdt">Số Điện Thoại:</label><br>
    <input type="text" id="sdt" name="sdt" required><br>
    <label for="diachi">Địa Chỉ:</label><br>
    <input type="text" id="diachi" name="diachi" required><br>
    <input type="submit" value="Đăng Ký">
    <h4 >Bạn đã có tài khoản? Vui lòng <a href="dangnhap.php"> Đăng Nhập </a></h4>

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