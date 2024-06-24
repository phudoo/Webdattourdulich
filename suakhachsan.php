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
    
    // Xử lý file hình ảnh nếu có upload
    $update_image = '';
    if (!empty($_FILES["hinhanh"]["name"])) {
        $target_dir = "images/KS/";
        
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $imageFileType = strtolower(pathinfo($_FILES["hinhanh"]["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . $makhachsan . '.' . $imageFileType;
        $name_file = $makhachsan . '.' . $imageFileType;
        
        if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
            $update_image = ", hinhanh='$name_file'";
        } else {
            echo "Có lỗi xảy ra khi upload hình ảnh.";
            exit();
        }
    }

    // Cập nhật thông tin khách sạn vào cơ sở dữ liệu
    $sql = "UPDATE khachsan SET tenkhachsan='$tenkhachsan', diachi='$diachi', sophong=$sophong, loaiphong='$loaiphong', giaphong=$giaphong $update_image WHERE makhachsan='$makhachsan'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Cập nhật khách sạn thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

// Lấy thông tin khách sạn từ cơ sở dữ liệu
if (isset($_GET["makhachsan"])) {
    $makhachsan = $_GET["makhachsan"];
    $sql = "SELECT * FROM khachsan WHERE makhachsan='$makhachsan'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Không tìm thấy khách sạn.";
        exit();
    }
} else {
    echo "Không có mã khách sạn.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chỉnh Sửa Khách Sạn</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h2>Chỉnh Sửa Khách Sạn</h2>
  <form method="post" action="suakhachsan.php" enctype="multipart/form-data">
    <input type="hidden" name="makhachsan" value="<?php echo $row['makhachsan']; ?>">
    <label for="tenkhachsan">Tên Khách Sạn:</label>
    <input type="text" name="tenkhachsan" id="tenkhachsan" value="<?php echo $row['tenkhachsan']; ?>" required>
    <br>
    <label for="diachi">Địa Chỉ:</label>
    <input type="text" name="diachi" id="diachi" value="<?php echo $row['diachi']; ?>" required>
    <br>
    <label for="sophong">Số Phòng:</label>
    <input type="number" name="sophong" id="sophong" value="<?php echo $row['sophong']; ?>" required>
    <br>
    <label for="loaiphong">Loại Phòng:</label>
    <select name="loaiphong" id="loaiphong" required>
        <option value="Đơn" <?php if ($row['loaiphong'] == 'Đơn') echo 'selected'; ?>>Đơn</option>
        <option value="Đôi" <?php if ($row['loaiphong'] == 'Đôi') echo 'selected'; ?>>Đôi</option>
    </select>
    <br>
    <label for="giaphong">Giá Phòng:</label>
    <input type="number" name="giaphong" id="giaphong" value="<?php echo $row['giaphong']; ?>" required>
    <br>
    <label for="hinhanh">Hình Ảnh:</label>
    <input type="file" name="hinhanh" id="hinhanh">
    <br>
    <?php if (!empty($row['hinhanh'])): ?>
        <img src="images/KS/<?php echo $row['hinhanh']; ?>" alt="Hình ảnh khách sạn" style="max-width: 200px; max-height: 200px;">
    <?php endif; ?>
    <br>
    <button type="submit">Lưu Thay Đổi</button>
  </form>
</body>
</html>
