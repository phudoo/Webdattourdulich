<?php
session_start();
include 'db.php'; // Kết nối CSDL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['matour'])) {
        $matour = $_POST['matour'];
        
        // Truy vấn CSDL để lấy thông tin của tour được chọn
        $sql = "SELECT * FROM tours WHERE matour = '$matour'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị thông tin của tour và xác nhận đặt tour
            $row = $result->fetch_assoc();
            $start_date = $_POST["start_date"];
            $quantity = $_POST["quantity"];
            $tentaikhoan = isset($_SESSION['tentaikhoan']) ? $_SESSION['tentaikhoan'] : 'Guest';

            // Tính toán giá vé dựa trên số lượng người
            $gia_ve = $row["giave"] * $quantity;

            // Lưu thông tin đặt tour vào bảng dattour
            $insert_sql = "INSERT INTO dattour (matour, tentour, diadiem, thoigian, soluongnguoi, tentaikhoan, ngaybatdau, giave) VALUES ('$matour', '{$row["tentour"]}', '{$row["diadiem"]}', '{$row["thoigian"]}', '$quantity', '$tentaikhoan', '$start_date', '$gia_ve')";
            
            if ($conn->query($insert_sql) === TRUE) {
                echo "<h2>Xác Nhận Đặt Tour</h2>";
                echo "<p><strong>Mã Tour:</strong> " . $row["matour"] . "</p>";
                echo "<p><strong>Tên Tour:</strong> " . $row["tentour"] . "</p>";
                echo "<p><strong>Ngày Bắt Đầu:</strong> $start_date</p>";
                echo "<p><strong>Số Lượng Người:</strong> $quantity</p>";
                echo "<p><strong>Giá Vé:</strong> $gia_ve</p>";
                echo "<p>Đặt tour thành công!</p>";
            
                
            } else {
                echo "<p class='error-message'>Có lỗi xảy ra khi đặt tour: " . $conn->error . "</p>";
            }
        } else {
            echo "<p class='error-message'>Không tìm thấy thông tin của tour.</p>";
        }
    } else {
        echo "<p class='error-message'>Không có mã tour được chọn.</p>";
    }
} else {
    // Kiểm tra xem có mã tour được chọn không
    if(isset($_GET['matour'])) {
        $matour = $_GET['matour'];
        
        // Truy vấn CSDL để lấy thông tin của tour được chọn
        $sql = "SELECT * FROM tours WHERE matour = '$matour'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị thông tin của tour và form đặt tour
            $row = $result->fetch_assoc();
            $tentaikhoan = isset($_SESSION['tentaikhoan']) ? $_SESSION['tentaikhoan'] : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đặt Tour</title>
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
            echo "<p class='error-message'>Không tìm thấy thông tin của tour.</p>";
        }
    } else {
        echo "<p class='error-message'>Không có mã tour được chọn.</p>";
    }
}
?>

<style> 
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
    text-align: center;
}

.container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #1e88e5;
}

p {
    margin-bottom: 10px;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}




button[type="submit"] {
    background-color: #1e88e5;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 3px;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #1565c0;
}

.error-message {
    color: red;
    margin-top: 10px;
}

</style>