<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $makhachsan = $_POST["makhachsan"];
  $tentaikhoan = $_POST["tentaikhoan"];
  $ngaynhanphong = $_POST["ngaynhanphong"];
  $ngaytraphong = $_POST["ngaytraphong"];

  $sql = "INSERT INTO datkhachsan (makhachsan, tentaikhoan, ngaynhanphong, ngaytraphong) VALUES ('$makhachsan', '$tentaikhoan', '$ngaynhanphong', '$ngaytraphong')";

  if ($conn->query($sql) === TRUE) {
    echo "Đặt phòng thành công!";
  } else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Đặt Phòng Khách Sạn</title>
  <link rel="stylesheet" href="cssdat.css">
</head>
<body>
  <h2>Đặt Phòng Khách Sạn</h2>
  <form method="post" action="datkhachsan.php">
    <label for="tentaikhoan">Tên Tài Khoản:</label><br>
    <input type="text" id="tentaikhoan" name="tentaikhoan" value="<?php echo $_SESSION['tentaikhoan']; ?>" readonly><br>
    <label for="tenkhachsan">Tên Khách Sạn:</label><br>
    <select id="tenkhachsan" name="tenkhachsan">
     <?php
  // Assuming $conn is your database connection
  $sql = "SELECT makhachsan, tenkhachsan FROM khachsan";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<option value='" . $row['makhachsan'] . "'>" . $row['tenkhachsan'] . "</option>";
    }
  }
  ?>
   </select><br>

    <label for="giaphong">Giá Phòng:</label><br>
<select id="giaphong" name="giaphong">
  <?php
  // Assuming $conn is your database connection
  $sql = "SELECT makhachsan, giaphong FROM khachsan";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<option value='" . $row['makhachsan'] . "'>" . $row['giaphong'] . "</option>";
    }
  }
  ?>
</select><br>

    <label for="loaiphong">Loại Phòng:</label><br>
    <select id="loaiphong" name="loaiphong">
      <option value="giuong-doi">Giường Đôi</option>
      <option value="giuong-don">Giường Đơn</option>
    </select><br>
    <label for="sodienthoai">Số Điện Thoại:</label><br>
    <input type="number" id="sodienthoai" name="sodienthoai"><br>
    <label for="ngaynhanphong">Ngày Nhận Phòng:</label><br>
    <input type="date" id="ngaynhanphong" name="ngaynhanphong"><br>
     <input type="submit" value="Đặt Phòng">
  </form>
</body>
</html>

