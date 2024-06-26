<?php
include 'db.php'; // Kết nối CSDL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['makhachsan'])) {
        $makhachsan = $_POST['makhachsan'];

        // Truy vấn CSDL để lấy thông tin của khách sạn được chọn
        $sql = "SELECT * FROM khachsan WHERE makhachsan = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $makhachsan);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Lấy thông tin của khách sạn
            $row = mysqli_fetch_assoc($result);
            $ngaynhanphong = $_POST["ngaynhanphong"];
            $sodienthoai = $_POST["sodienthoai"];
            $tentaikhoan = isset($_SESSION['tentaikhoan']) ? $_SESSION['tentaikhoan'] : 'Guest';

            // Tính toán giá phòng dựa trên số lượng phòng
            $gia_phong = $row["giaphong"];
            $tenkhachsan = $row["tenkhachsan"];
            $sophong = 1; // Assuming one room is booked for simplicity
            $diachi = $row["diachi"];

            // Lưu thông tin đặt phòng vào bảng `datkhachsan`
            $sql_insert = "INSERT INTO datkhachsan (makhachsan, tentaikhoan, ngaynhanphong, giaphong, tenkhachsan, sophong, sodienthoai, diachi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = mysqli_prepare($conn, $sql_insert);
            mysqli_stmt_bind_param($stmt_insert, "issisiss", $makhachsan, $tentaikhoan, $ngaynhanphong, $gia_phong, $tenkhachsan, $sophong, $sodienthoai, $diachi);

            if (mysqli_stmt_execute($stmt_insert)) {
                echo "<h2>Đặt Phòng Thành Công</h2>";
                echo "<p><strong>Mã Khách Sạn:</strong> " . $row["makhachsan"] . "</p>";
                echo "<p><strong>Tên Khách Sạn:</strong> " . $row["tenkhachsan"] . "</p>";
                echo "<p><strong>Loại Phòng:</strong> " . $row["loaiphong"] . "</p>";
                echo "<p><strong>Ngày Check-in:</strong> $ngaynhanphong</p>";
                echo "<p><strong>Số Điện Thoại:</strong> $sodienthoai</p>";
                echo "<p><strong>Tên Tài Khoản:</strong> $tentaikhoan</p>";
                echo "<p><strong>Giá Phòng:</strong> $gia_phong</p>";
                echo "<p>Đặt phòng thành công!</p>";
            } else {
                echo "<p>Có lỗi xảy ra khi đặt phòng. Vui lòng thử lại.</p>";
            }

            mysqli_stmt_close($stmt_insert);
        } else {
            echo "<p>Không tìm thấy thông tin của khách sạn.</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Không có mã khách sạn được chọn.</p>";
    }
} else {
    // Kiểm tra xem có mã khách sạn được chọn không
    if (isset($_GET['makhachsan'])) {
        $makhachsan = $_GET['makhachsan'];

        // Truy vấn CSDL để lấy thông tin của khách sạn được chọn
        $sql = "SELECT * FROM khachsan WHERE makhachsan = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $makhachsan);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Hiển thị thông tin của khách sạn và form đặt phòng
            $row = mysqli_fetch_assoc($result);
            $tentaikhoan = isset($_SESSION['tentaikhoan']) ? $_SESSION['tentaikhoan'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đặt Phòng</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h2>Thông Tin Khách Sạn</h2>
    <p><strong>Mã Khách Sạn:</strong> <?php echo $row["makhachsan"]; ?></p>
    <p><strong>Tên Khách Sạn:</strong> <?php echo $row["tenkhachsan"]; ?></p>
    <p><strong>Địa Chỉ:</strong> <?php echo $row["diachi"]; ?></p>
    <p><strong>Loại Phòng:</strong> <?php echo $row["loaiphong"]; ?></p>
    <p><strong>Số Phòng:</strong> <?php echo $row["sophong"]; ?></p>
    <?php
        // Tính toán giá phòng dựa trên số lượng phòng
        $gia_phong = $row["giaphong"];
    ?>
    <p><strong>Giá Phòng:</strong> <?php echo $gia_phong; ?></p>
    <p><strong>Tài Khoản:</strong> <?php echo $tentaikhoan; ?></p>
    <!-- Form để nhập thông tin đặt phòng -->
    <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="makhachsan" value="<?php echo $row["makhachsan"]; ?>">
        <label for="ngaynhanphong">Ngày Check-in:</label>
        <input type="date" id="ngaynhanphong" name="ngaynhanphong" required><br><br>
        <label for="sodienthoai">Số Điện Thoại:</label>
        <input type="text" id="sodienthoai" name="sodienthoai" required><br><br>
        <button type="submit">Đặt Phòng</button>
    </form>
</body>
</html>
<?php
        } else {
            echo "<p>Không tìm thấy thông tin của khách sạn.</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Không có mã khách sạn được chọn.</p>";
    }
}
?>
