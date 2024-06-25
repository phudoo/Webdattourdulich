<?php
$itemsPerPage = 4;

// Calculate total pages for tours
$tourSql = "SELECT COUNT(*) as total FROM tours";
$tourResult = $conn->query($tourSql);
$totalTours = $tourResult->fetch_assoc()['total'];
$totalTourPages = ceil($totalTours / $itemsPerPage);
$currentTourPage = isset($_GET['tour_page']) ? (int)$_GET['tour_page'] : 1;
$tourOffset = ($currentTourPage - 1) * $itemsPerPage;




// Calculate total pages for hotels
$hotelSql = "SELECT COUNT(*) as total FROM khachsan";
$hotelResult = $conn->query($hotelSql);
$totalHotels = $hotelResult->fetch_assoc()['total'];
$totalHotelPages = ceil($totalHotels / $itemsPerPage);
$currentHotelPage = isset($_GET['hotel_page']) ? (int)$_GET['hotel_page'] : 1;
$hotelOffset = ($currentHotelPage - 1) * $itemsPerPage;
?>
 

