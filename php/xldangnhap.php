<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["tentaikhoan"]) || empty($_POST["matkhau"])) {
        $_SESSION['login_message'] = "Vui lòng nhập đầy đủ tên tài khoản và mật khẩu.";
    } else {
      $tentaikhoan = $_POST["tentaikhoan"];
      $matkhau = $_POST["matkhau"];

        $sql = "SELECT * FROM taikhoan WHERE tentaikhoan='$tentaikhoan' AND matkhau='$matkhau'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
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
    mysqli_close($conn);
}
?>