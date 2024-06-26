<?php for ($i = 1; $i <= $totalTourPages; $i++): ?>
    <!-- Bắt đầu một vòng lặp để tạo các liên kết đến từng trang tour -->
    <a href="?tour_page=<?php echo $i; ?><?php if (isset($currentHotelPage)) echo '&hotel_page=' . $currentHotelPage; ?>">
        <!-- Đoạn mã trong thẻ <a> sẽ tạo liên kết đến trang $i của tour -->
        <?php echo $i; ?> <!-- Hiển thị số trang hiện tại là $i -->
    </a>
<?php endfor; ?>
