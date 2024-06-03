<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Danh Sách Tour</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>Danh Sách Các Tour Du Lịch</h1>
  <table>
    <tr>
        <th></th>
      <th>Mã Tour</th>
      <th>Tên Tour</th>
      <th>Địa Điểm</th>
      <th>Thời Gian</th>
      <th>Giá Vé</th>
      <th>Đặt Tour</th>
    </tr>
    <?php
    $sql = "SELECT * FROM tours";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><img src='" . $row["hinhanh"] . "' alt='Hình Ảnh Tour' style='width: 150px; height: auto;'></td>";
        echo "<td>" . $row["matour"] . "</td>";
        echo "<td>" . $row["tentour"] . "</td>";
        echo "<td>" . $row["diadiem"] . "</td>";
        echo "<td>" . $row["thoigian"] . "</td>";
        echo "<td>" . $row["giave"] . "</td>";
        echo '<td><a href="dattour.php?matour=' . $row["matour"] . '">Đặt Tour</a></td>';
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='7'>Không có tour nào</td></tr>";
    }
    $conn->close();
    ?>
  </table>
</body>
</html>
