<?php
// Kiểm tra nếu phương thức yêu cầu là POST để xử lý dữ liệu đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["tentaikhoan"]) || empty($_POST["matkhau"])) {
        
        $_SESSION['login_message'] = "Vui lòng nhập đầy đủ tên tài khoản và mật khẩu.";
    } else {
        // Lấy dữ liệu tên tài khoản và mật khẩu từ form đăng nhập
        $tentaikhoan = $_POST["tentaikhoan"];
        $matkhau = $_POST["matkhau"];

    
        $sql = "SELECT * FROM taikhoan WHERE tentaikhoan='$tentaikhoan' AND matkhau='$matkhau'";
        // Thực thi câu truy vấn
        $result = mysqli_query($conn, $sql);

        // Kiểm tra số lượng bản ghi trả về từ câu truy vấn
        if (mysqli_num_rows($result) > 0) {
            // Nếu tồn tại tài khoản, thiết lập session lưu trữ tên tài khoản đã đăng nhập
            $_SESSION['tentaikhoan'] = $tentaikhoan;
           
            if ($tentaikhoan === 'admin') {
                header("Location: quanly.php");
                exit(); 
            } else {
              
                header("Location: index.php");
                exit(); 
            }
        } else {
            // Nếu không tìm thấy tài khoản trong cơ sở dữ liệu, thiết lập thông báo lỗi vào session
            $_SESSION['login_message'] = "Sai tên tài khoản hoặc mật khẩu!";
        }
    }
    // Đóng kết nối đến cơ sở dữ liệu
    mysqli_close($conn);
}
?>
