<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/controllers/BookingController.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$controller = new BookingController();
$controller->listUserBookings($pdo);
?>
