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
    $matour = $_POST["matour"];
    $tentour = $_POST["tentour"];
    $diadiem = $_POST["diadiem"];
    $thoigian = $_POST["thoigian"];
    $giave = $_POST["giave"];

    // Kiểm tra mã tour đã tồn tại hay chưa
    $check_sql = "SELECT * FROM tours WHERE matour = '$matour'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Mã tour đã tồn tại. Vui lòng nhập mã khác.";
    } else {
        // Xử lý file hình ảnh
        $target_dir = "images/TOUR/";
        
        // Kiểm tra thư mục uploads có tồn tại không, nếu không thì tạo mới
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $imageFileType = strtolower(pathinfo($_FILES["hinhanh"]["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . $matour . '.' . $imageFileType;
        $name_file = $matour . '.' . $imageFileType;
        
        if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
            // Lưu thông tin tour vào cơ sở dữ liệu
            $sql = "INSERT INTO tours (matour, tentour, diadiem, thoigian, giave, hinhanh) VALUES ('$matour', '$tentour', '$diadiem', '$thoigian', $giave, '$name_file')";
            
            if (mysqli_query($conn, $sql)) {
                echo "Thêm mới tour du lịch thành công!";
            } else {
                echo "Lỗi: " . mysqli_error($conn);
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
  <title>Thêm Mới Tour Du Lịch</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h2>Thêm Mới Tour Du Lịch</h2>
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
    <label for="matour">Mã Tour:</label>
    <input type="text" name="matour" id="matour" required>
    <br>
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
