<?php

include 'db.php'; // Kết nối đến cơ sở dữ liệu để thực hiện các truy vấn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['matour'])) {
        $matour = $_POST['matour'];
        
        // Truy vấn CSDL để lấy thông tin của tour được chọn
        $sql = "SELECT * FROM tours WHERE matour = '$matour'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Nếu tồn tại thông tin của tour trong cơ sở dữ liệu
            $row = $result->fetch_assoc();
            $start_date = $_POST["start_date"];
            $quantity = $_POST["quantity"];
            $tentaikhoan = isset($_SESSION['tentaikhoan']) ? $_SESSION['tentaikhoan'] : 'Guest';

            // Tính toán giá vé dựa trên số lượng người
            $gia_ve = $row["giave"] * $quantity;

            // Lưu thông tin đặt tour vào bảng dattour
            $insert_sql = "INSERT INTO dattour (matour, tentour, diadiem, thoigian, soluongnguoi, tentaikhoan, ngaybatdau, giave) VALUES ('$matour', '{$row["tentour"]}', '{$row["diadiem"]}', '{$row["thoigian"]}', '$quantity', '$tentaikhoan', '$start_date', '$gia_ve')";
            
            // Thực hiện truy vấn insert và kiểm tra kết quả
            if ($conn->query($insert_sql) === TRUE) {
                // Nếu insert thành công, hiển thị thông tin xác nhận
                echo "<h2>Xác Nhận Đặt Tour</h2>";
                echo "<p><strong>Mã Tour:</strong> " . $row["matour"] . "</p>";
                echo "<p><strong>Tên Tour:</strong> " . $row["tentour"] . "</p>";
                echo "<p><strong>Ngày Bắt Đầu:</strong> $start_date</p>";
                echo "<p><strong>Số Lượng Người:</strong> $quantity</p>";
                echo "<p><strong>Giá Vé:</strong> $gia_ve</p>";
                echo "<p>Đặt tour thành công!</p>";
            } else {
                // Nếu có lỗi trong quá trình insert, hiển thị thông báo lỗi
                echo "<p class='error-message'>Có lỗi xảy ra khi đặt tour: " . $conn->error . "</p>";
            }
        } else {
            // Nếu không tìm thấy thông tin của tour trong cơ sở dữ liệu
            echo "<p class='error-message'>Không tìm thấy thông tin của tour.</p>";
        }
    } else {
        // Nếu không có mã tour được chọn trong POST data
        echo "<p class='error-message'>Không có mã tour được chọn.</p>";
    }
} else {
    // Nếu không phải là phương thức POST, hiển thị form đặt tour
    if(isset($_GET['matour'])) {
        $matour = $_GET['matour'];
        
        // Truy vấn CSDL để lấy thông tin của tour được chọn
        $sql = "SELECT * FROM tours WHERE matour = '$matour'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Nếu tồn tại thông tin của tour trong cơ sở dữ liệu
            $row = $result->fetch_assoc();
            $tentaikhoan = isset($_SESSION['tentaikhoan']) ? $_SESSION['tentaikhoan'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đặt Tour</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
    <h2>Thông Tin Tour</h2>
    <p><strong>Mã Tour:</strong> <?php echo $row["matour"]; ?></p>
    <p><strong>Tên Tour:</strong> <?php echo $row["tentour"]; ?></p>
    <p><strong>Địa Điểm:</strong> <?php echo $row["diadiem"]; ?></p>
    <p><strong>Thời Gian:</strong> <?php echo $row["thoigian"]; ?></p>
    <?php
        // Tính toán giá vé dựa trên số lượng người
        $gia_ve = $row["giave"];
    ?>
    <p><strong>Giá Vé:</strong> <?php echo $gia_ve; ?></p>
    <p><strong>Tài Khoản:</strong> <?php echo $tentaikhoan; ?></p>
    <!-- Form để nhập thông tin đặt tour -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="matour" value="<?php echo $row["matour"]; ?>">
        <label for="start_date">Ngày Bắt Đầu:</label>
        <input type="date" id="start_date" name="start_date" required><br>
        <label for="quantity">Số Lượng Người:</label>
        <input type="number" id="quantity" name="quantity" min="1" required><br>
        <button type="submit">Đặt Tour</button>
    </form>
</div>
</body>
</html>
<?php
        } else {
            // Nếu không tìm thấy thông tin của tour trong cơ sở dữ liệu
            echo "<p class='error-message'>Không tìm thấy thông tin của tour.</p>";
        }
    } else {
        // Nếu không có mã tour được chọn trong query string
        echo "<p class='error-message'>Không có mã tour được chọn.</p>";
    }
}
?>
