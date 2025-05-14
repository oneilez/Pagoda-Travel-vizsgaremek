<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/controllers/TripController.php';

$controller = new TripController();
$controller->index($pdo); // összes utazást megjeleníti