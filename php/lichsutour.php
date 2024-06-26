<?php


$sql = "SELECT * FROM dattour WHERE tentaikhoan = '" . $_SESSION['tentaikhoan'] . "'";
$result = mysqli_query($conn, $sql); // Thực thi câu truy vấn và lấy kết quả

// Kiểm tra số lượng bản ghi trả về từ câu truy vấn
if (mysqli_num_rows($result) > 0) {
    // Nếu có ít nhất một bản ghi trả về, thực hiện vòng lặp để lấy từng dòng dữ liệu
    while ($row = mysqli_fetch_assoc($result)) {
        // Lặp qua từng dòng kết quả và hiển thị thông tin về tên tour và ngày bắt đầu
        echo "<p><strong>Tên Tour:</strong> " . $row["tentour"] . " - <strong>Ngày Bắt Đầu:</strong> " . $row["ngaybatdau"] . "</p>";
    }
} else {

    echo "<p>Không có lịch sử đặt tour</p>";
}
?>
