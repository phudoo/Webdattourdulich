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

$matour = $_GET['matour'] ?? '';
if (!$matour) {
    echo "Mã tour không hợp lệ.";
    exit();
}

// Fetch the tour data
$sql = "SELECT * FROM tours WHERE matour = '$matour'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Không tìm thấy tour.";
    exit();
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tentour = $_POST["tentour"];
    $diadiem = $_POST["diadiem"];
    $thoigian = $_POST["thoigian"];
    $giave = $_POST["giave"];
    $hinhanh = $row['hinhanh']; // Default to existing image

    // Kiểm tra nếu người dùng upload hình ảnh mới
    if (isset($_FILES["hinhanh"]) && $_FILES["hinhanh"]["error"] == 0) {
        $target_dir = "images/TOUR/";
        
        // Kiểm tra thư mục uploads có tồn tại không, nếu không thì tạo mới
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $imageFileType = strtolower(pathinfo($_FILES["hinhanh"]["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . $matour . '.' . $imageFileType;
        $name_file = $matour . '.' . $imageFileType;

        if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
            $hinhanh = $name_file;
        } else {
            echo "Có lỗi xảy ra khi upload hình ảnh.";
            exit();
        }
    }

    // Cập nhật thông tin tour vào cơ sở dữ liệu
    $sql = "UPDATE tours SET tentour='$tentour', diadiem='$diadiem', thoigian='$thoigian', giave=$giave, hinhanh='$hinhanh' WHERE matour='$matour'";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Cập nhật tour thành công!');
                window.location.href = 'quanly_tour.php';
              </script>";
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chỉnh Sửa Tour Du Lịch</title>
  <link rel="stylesheet" href="css/edit.css">
</head>
<body>
  <h2>Chỉnh Sửa Tour Du Lịch</h2>
  <form method="post" action="suatour.php?matour=<?php echo $row['matour']; ?>" enctype="multipart/form-data">
    <input type="hidden" name="matour" value="<?php echo $row['matour']; ?>">
    <label for="tentour">Tên Tour:</label>
    <input type="text" name="tentour" id="tentour" value="<?php echo $row['tentour']; ?>" required>
    <br>
    <label for="diadiem">Địa Điểm:</label>
    <input type="text" name="diadiem" id="diadiem" value="<?php echo $row['diadiem']; ?>" required>
    <br>
    <label for="thoigian">Thời Gian:</label>
    <input type="text" name="thoigian" id="thoigian" value="<?php echo $row['thoigian']; ?>" required>
    <br>
    <label for="giave">Giá Vé:</label>
    <input type="number" name="giave" id="giave" value="<?php echo $row['giave']; ?>" required>
    <br>
    <label for="hinhanh">Hình Ảnh:</label>
    <input type="file" name="hinhanh" id="hinhanh">
    <br>
    <?php if (!empty($row['hinhanh'])): ?>
        <img src="images/TOUR/<?php echo $row['hinhanh']; ?>" alt="Hình ảnh tour du lịch" style="max-width: 200px; max-height: 200px;">
    <?php endif; ?>
    <br>
    <input type="submit" value="Cập nhật">
    <a href="quanly_tour.php" class="btn-cancel">Hủy</a>
  </form>
</body>
</html>

