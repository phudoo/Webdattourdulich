

<?php for ($i = 1; $i <= $totalTourPages; $i++): ?>
        <a href="?tour_page=<?php echo $i; ?><?php if (isset($currentHotelPage)) echo '&hotel_page=' . $currentHotelPage; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>