<?php
require_once __DIR__ . '/../models/Trip.php';


class HomeController {
    public function index($pdo) {
        $tripModel = new Trip($pdo);

        // Csak 3 utazás a főoldalra, szállásokkal együtt
        $trips = $tripModel->getLimitedTrips(5);

        require __DIR__ . '/../views/index.php'; // főoldal nézet
    }
}

