<?php
$itemsPerPage = 4; // Số lượng mục (items) hiển thị trên mỗi trang

// Tính tổng số trang cho tours
$tourSql = "SELECT COUNT(*) as total FROM tours"; // Câu truy vấn đếm tổng số bản ghi trong bảng 'tours'
$tourResult = mysqli_query($conn, $tourSql); // Thực thi truy vấn SQL và lưu kết quả vào biến $tourResult
$totalToursRow = mysqli_fetch_assoc($tourResult); // Lấy kết quả dưới dạng mảng kết hợp (associative array)
$totalTours = $totalToursRow['total']; // Truy cập giá trị của cột 'total' từ kết quả truy vấn
$totalTourPages = ceil($totalTours / $itemsPerPage); // Tính tổng số trang, làm tròn lên nếu có dư
$currentTourPage = isset($_GET['tour_page']) ? (int)$_GET['tour_page'] : 1; // Lấy trang hiện tại từ tham số GET, mặc định là 1 nếu không có tham số
$tourOffset = ($currentTourPage - 1) * $itemsPerPage; // Tính vị trí bắt đầu cho truy vấn phân trang

// Tính tổng số trang cho hotels
$hotelSql = "SELECT COUNT(*) as total FROM khachsan"; // Câu truy vấn đếm tổng số bản ghi (dòng) trong bảng 'khachsan'
$hotelResult = mysqli_query($conn, $hotelSql); // Thực thi truy vấn SQL và lưu kết quả vào biến $hotelResult
$totalHotelsRow = mysqli_fetch_assoc($hotelResult); // Lấy kết quả dưới dạng mảng kết hợp (associative array)
$totalHotels = $totalHotelsRow['total']; // Truy cập giá trị của cột 'total' từ kết quả truy vấn
$totalHotelPages = ceil($totalHotels / $itemsPerPage); // Tính tổng số trang, làm tròn lên nếu có dư
$currentHotelPage = isset($_GET['hotel_page']) ? (int)$_GET['hotel_page'] : 1; // Lấy trang hiện tại từ tham số GET, mặc định là 1 nếu không có tham số
$hotelOffset = ($currentHotelPage - 1) * $itemsPerPage; // Tính vị trí bắt đầu cho truy vấn phân trang
?>
