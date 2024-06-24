<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Danh Sách Khách Sạn</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <h1>Danh Sách Các Khách Sạn</h1>
  <table>
    <tr>
      <th></th>
      <th>Mã Khách Sạn</th>
      <th>Tên Khách Sạn</th>
      <th>Địa Chỉ</th>
      <th>Số Phòng</th>
      <th>Giá Phòng</th>
      <th>Đặt Phòng</th>
    </tr>
    <?php
    $sql = "SELECT * FROM khachsan";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><img src='images/KS/" . $row["hinhanh"] . ".PNG' alt='Hình Ảnh Khách Sạn' style='width: 150px; height: auto;'></td>";
        echo "<td>" . $row["makhachsan"] . "</td>";
        echo "<td>" . $row["tenkhachsan"] . "</td>";
        echo "<td>" . $row["diachi"] . "</td>";
        echo "<td>" . $row["sophong"] . "</td>";
        echo "<td>" . $row["giaphong"] . "</td>";
        echo '<td><a href="datkhachsan.php?makhachsan=' . $row["makhachsan"] . '">Đặt Phòng</a></td>';
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='7'>Không có khách sạn nào</td></tr>";
    }
    $conn->close();
    ?>
  </table>
</body>
</html>
