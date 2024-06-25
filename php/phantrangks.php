

<?php for ($i = 1; $i <= $totalHotelPages; $i++): ?>
        <a href="?hotel_page=<?php echo $i; ?><?php if (isset($currentTourPage)) echo '&tour_page=' . $currentTourPage; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>