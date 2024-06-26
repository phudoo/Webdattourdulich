<?php
// Kết nối đến cơ sở dữ liệu
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['tentaikhoan']) || $_SESSION['tentaikhoan'] != 'admin') {
    header("Location: dangnhap.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $makhachsan = $_POST["makhachsan"];
    $tenkhachsan = $_POST["tenkhachsan"];
    $diachi = $_POST["diachi"];
    $sophong = $_POST["sophong"];
    $loaiphong = $_POST["loaiphong"];
    $giaphong = $_POST["giaphong"];
    
    // Kiểm tra mã khách sạn đã tồn tại hay chưa
    $check_sql = "SELECT * FROM khachsan WHERE makhachsan = '$makhachsan'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Mã khách sạn đã tồn tại. Vui lòng nhập mã khác.";
    } else {
        // Xử lý file hình ảnh
        $target_dir = "images/KS/";
        
        // Kiểm tra thư mục uploads có tồn tại không, nếu không thì tạo mới
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $imageFileType = strtolower(pathinfo($_FILES["hinhanh"]["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . $makhachsan . '.' . $imageFileType;
        $name_file = $makhachsan . '.' . $imageFileType;
        
        if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
            // Lưu thông tin khách sạn vào cơ sở dữ liệu
            $sql = "INSERT INTO khachsan (makhachsan, tenkhachsan, diachi, sophong, loaiphong, giaphong, hinhanh) VALUES ('$makhachsan', '$tenkhachsan', '$diachi', $sophong, '$loaiphong', $giaphong, '$name_file')";
            
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Thêm mới khách sạn thành công!');
                window.location.href = 'quanly_khachsan.php';
              </script>";
        exit();
            } else {
                echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Có lỗi xảy ra khi upload hình ảnh.";
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thêm Mới Khách Sạn</title>
  <link rel="stylesheet" href="css/edit.css">
</head>
<body>
  <h2>Thêm Mới Khách Sạn</h2>
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
    <label for="makhachsan">Mã Khách Sạn:</label>
    <input type="text" name="makhachsan" id="makhachsan" required>
    <br>
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
    <label for="hinhanh">Hình Ảnh:</label>
    <input type="file" name="hinhanh" id="hinhanh" accept="image/*" required>
    <br>
    <input type="submit" value="Thêm">
    <a href="quanly_khachsan.php" class="btn-cancel">Hủy</a>
  </form>
</body>
</html>
