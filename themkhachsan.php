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
    $hinhanh = $_FILES['hinhanh']['name'];

    // Kiểm tra và upload hình ảnh
    if (!empty($hinhanh)) {
        $target_dir = "images/KS/";
        $target_file = $target_dir . basename($hinhanh);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra loại file hình ảnh
        $check = getimagesize($_FILES["hinhanh"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File không phải là hình ảnh.";
            $uploadOk = 0;
        }

        // Kiểm tra xem file đã tồn tại
        if (file_exists($target_file)) {
            echo "File đã tồn tại.";
            $uploadOk = 0;
        }

        // Kiểm tra kích thước file
        if ($_FILES["hinhanh"]["size"] > 5000000) {
            echo "File quá lớn.";
            $uploadOk = 0;
        }

        // Chỉ cho phép các định dạng hình ảnh nhất định
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Chỉ chấp nhận các file JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }

        // Kiểm tra xem $uploadOk có bị đặt thành 0 bởi lỗi không
        if ($uploadOk == 0) {
            echo "File không được upload.";
        // nếu mọi thứ ok, cố gắng upload file
        } else {
            if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_dir . $tenkhachsan . '.' . $imageFileType)) {
                $hinhanh = $tenkhachsan . '.' . $imageFileType;
                echo "File ". htmlspecialchars($hinhanh). " đã được upload.";
            } else {
                echo "Có lỗi khi upload file.";
            }            
        }
    }

    // Thực hiện thêm khách sạn vào cơ sở dữ liệu
    $sql = "INSERT INTO khachsan (tenkhachsan, diachi, sophong, loaiphong, giaphong, hinhanh) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisss", $tenkhachsan, $diachi, $sophong, $loaiphong, $giaphong, $hinhanh);

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
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
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
    <button type="submit">Thêm Khách Sạn</button>
  </form>
</body>
</html>
