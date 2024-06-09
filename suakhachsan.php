<?php
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['tentaikhoan']) || $_SESSION['tentaikhoan'] != 'admin') {
    header("Location: dangnhap.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['makhachsan'])) {
    $makhachsan = $_POST['makhachsan'];
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
        if ($_FILES["hinhanh"]["size"] > 50000000) {
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
            if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_dir . $makhachsan . '.' . $imageFileType)) {
                $hinhanh = $makhachsan . '.' . $imageFileType;
                echo "File ". htmlspecialchars($hinhanh). " đã được upload.";
            } else {
                echo "Có lỗi khi upload file.";
            }            
        }
    }

    // Cập nhật thông tin khách sạn
    if (!empty($hinhanh)) {
        $sql_update = "UPDATE khachsan SET tenkhachsan=?, diachi=?, sophong=?, loaiphong=?, giaphong=?, hinhanh=? WHERE makhachsan=?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("ssissis", $tenkhachsan, $diachi, $sophong, $loaiphong, $giaphong, $hinhanh, $makhachsan);
        } else {
            $sql_update = "UPDATE khachsan SET tenkhachsan=?, diachi=?, sophong=?, loaiphong=?, giaphong=?, hinhanh=? WHERE makhachsan=?";
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("ssissis", $tenkhachsan, $diachi, $sophong, $loaiphong, $giaphong, $hinhanh, $makhachsan);           
        }

    if ($stmt->execute()) {
        echo "Cập nhật khách sạn thành công.";
    } else {
        echo "Có lỗi xảy ra khi cập nhật khách sạn.";
    }

    $stmt->close();
    $conn->close();
    header("Location: quanly.php");
    exit();
} else if (isset($_GET['makhachsan'])) {
    $makhachsan = $_GET['makhachsan'];

    // Lấy thông tin khách sạn từ cơ sở dữ liệu
    $sql = "SELECT * FROM khachsan WHERE makhachsan=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $makhachsan);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <title>Chỉnh Sửa Khách Sạn</title>
          <link rel="stylesheet" href="styles.css">
        </head>
        <body>
          <h2>Chỉnh Sửa Khách Sạn</h2>
          <form method="post" action="suakhachsan.php" enctype="multipart/form-data">
            <input type="hidden" name="makhachsan" value="<?php echo htmlspecialchars($row['makhachsan']); ?>">
            <label for="tenkhachsan">Tên Khách Sạn:</label>
            <input type="text" name="tenkhachsan" id="tenkhachsan" value="<?php echo htmlspecialchars($row['tenkhachsan']); ?>" required>
            <br>
            <label for="diachi">Địa Chỉ:</label>
            <input type="text" name="diachi" id="diachi" value="<?php echo htmlspecialchars($row['diachi']); ?>" required>
            <br>
            <label for="sophong">Số Phòng:</label>
            <input type="number" name="sophong" id="sophong" value="<?php echo htmlspecialchars($row['sophong']); ?>" required>
            <br>
            <label for="loaiphong">Loại Phòng:</label>
            <select name="loaiphong" id="loaiphong" required>
                <option value="Đơn" <?php if ($row['loaiphong'] == 'Đơn') echo 'selected'; ?>>Đơn</option>
                <option value="Đôi" <?php if ($row['loaiphong'] == 'Đôi') echo 'selected'; ?>>Đôi</option>
            </select>
            <br>
            <label for="giaphong">Giá Phòng:</label>
            <input type="number" name="giaphong" id="giaphong" value="<?php echo htmlspecialchars($row['giaphong']); ?>" required>
            <br>
            <label for="hinhanh">Hình Ảnh:</label>
            <input type="file" name="hinhanh" id="hinhanh">
            <br>
            <?php if (!empty($row['hinhanh'])): ?>
                <img src="images/<?php echo htmlspecialchars($row['hinhanh']); ?>" alt="Hình ảnh khách sạn" style="max-width: 200px; max-height: 200px;">
            <?php endif; ?>
            <br>
            <button type="submit">Lưu Thay Đổi</button>
          </form>
        </body>
        </html>

        <?php
    } else {
        echo "Không tìm thấy khách sạn để chỉnh sửa.";
    }

    $stmt->close();
    $conn->close();
}
?>