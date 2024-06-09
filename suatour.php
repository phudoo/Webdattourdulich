<?php
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['tentaikhoan']) || $_SESSION['tentaikhoan'] != 'admin') {
    header("Location: dangnhap.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['matour'])) {
    $matour = $_POST['matour'];
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
            if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_dir . $matour . '.' . $imageFileType)) {
                $hinhanh = $matour . '.' . $imageFileType;
                echo "File ". htmlspecialchars($hinhanh). " đã được upload.";
            } else {
                echo "Có lỗi khi upload file.";
            }            
        }
    }

    // Cập nhật thông tin tour du lịch
    if (!empty($hinhanh)) {
        $sql_update = "UPDATE tours SET tentour=?, diadiem=?, thoigian=?, giave=?, hinhanh=? WHERE matour=?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("ssssis", $tentour, $diadiem, $thoigian, $giave, $hinhanh, $matour);
    } else {
        $sql_update = "UPDATE tours SET tentour=?, diadiem=?, thoigian=?, giave=? WHERE matour=?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("ssssi", $tentour, $diadiem, $thoigian, $giave, $matour);           
    }

    if ($stmt->execute()) {
        echo "Cập nhật tour du lịch thành công.";
    } else {
        echo "Có lỗi xảy ra khi cập nhật tour du lịch.";
    }

    $stmt->close();
    $conn->close();
    header("Location: quanly.php");
    exit();
} else if (isset($_GET['matour'])) {
    $matour = $_GET['matour'];

    // Lấy thông tin tour du lịch từ cơ sở dữ liệu
    $sql = "SELECT * FROM tours WHERE matour=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matour);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

<!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <title>Chỉnh Sửa Tour Du Lịch</title>
          <link rel="stylesheet" href="styles.css">
        </head>
        <body>
          <h2>Chỉnh Sửa Tour Du Lịch</h2>
          <form method="post" action="suatour.php" enctype="multipart/form-data">
            <input type="hidden" name="matour" value="<?php echo htmlspecialchars($row['matour']); ?>">
            <label for="tentour">Tên Tour:</label>
            <input type="text" name="tentour" id="tentour" value="<?php echo htmlspecialchars($row['tentour']); ?>" required>
            <br>
            <label for="diadiem">Địa Điểm:</label>
            <input type="text" name="diadiem" id="diadiem" value="<?php echo htmlspecialchars($row['diadiem']); ?>" required>
            <br>
            <label for="thoigian">Thời Gian:</label>
            <input type="text" name="thoigian" id="thoigian" value="<?php echo htmlspecialchars($row['thoigian']); ?>" required>
            <br>
            <label for="giave">Giá Vé:</label>
            <input type="number" name="giave" id="giave" value="<?php echo htmlspecialchars($row['giave']); ?>" required>
            <br>
            <label for="hinhanh">Hình Ảnh:</label>
            <input type="file" name="hinhanh" id="hinhanh">
            <br>
            <?php if (!empty($row['hinhanh'])): ?>
                <img src="images/TOUR/<?php echo htmlspecialchars($row['hinhanh']); ?>" alt="Hình ảnh tour du lịch" style="max-width: 200px; max-height: 200px;">
            <?php endif; ?>
            <br>
            <button type="submit">Lưu Thay Đổi</button>
          </form>
        </body>
        </html>

        <?php
    } else {
        echo "Không tìm thấy tour du lịch để chỉnh sửa.";
    }

    $stmt->close();
    $conn->close();
}
?>
