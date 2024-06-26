<?php for ($i = 1; $i <= $totalHotelPages; $i++): ?>
    <!-- Bắt đầu vòng lặp để tạo các liên kết đến từng trang khách sạn -->
    <a href="?hotel_page=<?php echo $i; ?><?php if (isset($currentTourPage)) echo '&tour_page=' . $currentTourPage; ?>">
        <!-- Đoạn mã trong thẻ <a> sẽ tạo liên kết đến trang $i của khách sạn -->
        <?php echo $i; ?> <!-- Hiển thị số trang hiện tại là $i -->
    </a>
<?php endfor; ?>
