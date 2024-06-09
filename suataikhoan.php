<?php
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['tentaikhoan']) || $_SESSION['tentaikhoan'] != 'admin') {
    header("Location: dangnhap.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tentaikhoan'])) {
    $tentaikhoan = $_POST['tentaikhoan'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];

    // Cập nhật thông tin tài khoản
    $sql_update = "UPDATE taikhoan SET email=?, sdt=?, diachi=? WHERE tentaikhoan=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssss", $email, $sdt, $diachi, $tentaikhoan);

    if ($stmt->execute()) {
        echo "Cập nhật tài khoản thành công.";
    } else {
        echo "Có lỗi xảy ra khi cập nhật tài khoản.";
    }

    $stmt->close();
    $conn->close();
    header("Location: quanly.php");
    exit();
} else if (isset($_GET['tentaikhoan'])) {
    $tentaikhoan = $_GET['tentaikhoan'];

    // Lấy thông tin tài khoản từ cơ sở dữ liệu
    $sql = "SELECT * FROM taikhoan WHERE tentaikhoan=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tentaikhoan);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <title>Chỉnh Sửa Tài Khoản</title>
          <link rel="stylesheet" href="styles.css">
        </head>
        <body>
          <h2>Chỉnh Sửa Tài Khoản</h2>
          <form method="post" action="suataikhoan.php">
            <input type="hidden" name="tentaikhoan" value="<?php echo htmlspecialchars($row['tentaikhoan']); ?>">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            <br>
            <label for="sdt">Số Điện Thoại:</label>
            <input type="text" name="sdt" id="sdt" value="<?php echo htmlspecialchars($row['sdt']); ?>" required>
            <br>
            <label for="diachi">Địa Chỉ:</label>
            <input type="text" name="diachi" id="diachi" value="<?php echo htmlspecialchars($row['diachi']); ?>" required>
            <br>
            <input type="submit" value="Cập Nhật">
          </form>
        </body>
        </html>

        <?php
    } else {
        echo "Không tìm thấy thông tin tài khoản.";
    }

    $stmt->close();
} else {
    echo "Không tìm thấy tài khoản để chỉnh sửa.";
}
$conn->close();
?>
