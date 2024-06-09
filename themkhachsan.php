<?php
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['tentaikhoan']) || $_SESSION['tentaikhoan'] != 'admin') {
    header("Location: dangnhap.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $tentour = $_POST['tentour'];
    $diadiem = $_POST['diadiem'];
    $thoigian = $_POST['thoigian'];
    $giave = $_POST['giave'];
    $hinhanh = $_FILES['hinhanh']['name'];

    // Kiểm tra và upload hình ảnh
    if (!empty($hinhanh)) {
        $target_dir = "images/TOUR/";
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
            if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_dir . $tentour . '.' . $imageFileType)) {
                $hinhanh = $tentour . '.' . $imageFileType;
                echo "File ". htmlspecialchars($hinhanh). " đã được upload.";
            } else {
                echo "Có lỗi khi upload file.";
            }            
        }
    }

    // Thêm tour du lịch vào cơ sở dữ liệu
    $sql = "INSERT INTO tours (tentour, diadiem, thoigian, giave, hinhanh) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $tentour, $diadiem, $thoigian, $giave, $hinhanh);

    if ($stmt->execute()) {
        echo "Thêm tour du lịch thành công.";
    } else {
        echo "Có lỗi xảy ra khi thêm tour du lịch: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thêm Mới Tour Du Lịch</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h2>Thêm Mới Tour Du Lịch</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <label for="tentour">Tên Tour:</label>
    <input type="text" name="tentour" id="tentour" required>
    <br>
    <label for="diadiem">Địa Điểm:</label>
    <input type="text" name="diadiem" id="diadiem" required>
    <br>
    <label for="thoigian">Thời Gian:</label>
    <input type="text" name="thoigian" id="thoigian" required>
    <br>
    <label for="giave">Giá Vé:</label>
    <input type="number" name="giave" id="giave" required>
    <br>
    <label for="hinhanh">Hình Ảnh:</label>
    <input type="file" name="hinhanh" id="hinhanh" accept="image/*" required>
    <br>
    <button type="submit" name="submit">Thêm Tour</button>
  </form>
</body>
</html>
