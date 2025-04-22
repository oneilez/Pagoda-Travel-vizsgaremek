<?php

require_once __DIR__ . '/../models/Trip.php';

class TripController {
    public function index($pdo, $limit = null) {
        $tripModel = new Trip($pdo);

        // Alap utazások lekérése, már tartalmazzák a szállásokat is JOIN-nel
        //$trips = $limit ? $tripModel->getLimitedTrips($limit) : $tripModel->getAllTrips();
        $trips = $limit ? $tripModel->getLimitedTrips($limit) : $tripModel->getAllTrips();
        // Szűrés: csak egyedi id-jű utak (ha mégis duplikálódnának)
        /*$uniqueTrips = [];
        $seenIds = [];
        foreach ($trips as $trip) {
            if (!in_array($trip['id'], $seenIds)) {
                $uniqueTrips[] = $trip;
                $seenIds[] = $trip['id'];
            }
        }
        $trips = $uniqueTrips;
        */
        require __DIR__ . '/../views/trips/index.php';
    }

    public function store($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_trip'])) {
            $departure = $_POST['departure'];
            $arrival = $_POST['arrival'];
            $price = $_POST['price_per_person'];
            $destination_id = $_POST['destination_id'];
            $available_spots = $_POST['available_spots'];
            $short_description = $_POST['short_description'] ?? null;
            $full_description = $_POST['full_description'] ?? null;

            // Kép feltöltés
            $image_path = null;
            if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
                $fileName = time() . '_' . basename($_FILES['image_path']['name']);
                $uploadDir = __DIR__ . '/../../public/uploads/';
                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image_path']['tmp_name'], $targetPath)) {
                    $image_path = $fileName; // csak a fájlnevet mentjük az adatbázisba
                }
            }

            // Mentés
            $tripModel = new Trip($pdo);
            $tripModel->add(
                $departure,
                $arrival,
                $price,
                $destination_id,
                $image_path,
                $short_description,
                $full_description,
                $available_spots
            );

            header("Location: admin.php?page=trip_form");
            exit();
        }
    }
}
