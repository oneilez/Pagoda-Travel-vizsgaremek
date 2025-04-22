
<?php

class Trip {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Új utazás hozzáadása
    public function add($departure, $arrival, $price_per_person, $destination_id, $image_path = null, $short_description = null, $full_description = null, $available_spots) {
        $stmt = $this->pdo->prepare("INSERT INTO trips (departure, arrival, price_per_person, destination_id, image_url, short_description, full_description, available_spots)
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $departure,
            $arrival,
            $price_per_person,
            $destination_id,
            $image_path,
            $short_description,
            $full_description,
            $available_spots
        ]);
    }
    public function getAllTrips() {
        $stmt = $this->pdo->query("
            SELECT 
                t.*,
                d.destination, d.city, d.country,
                a.id AS accommodation_id, 
                a.name_of_accommoda, 
                a.address, 
                a.rating, 
                a.price_per_night_per_per,
                a.destination_id AS accommodation_destination_id
            FROM trips t
            JOIN destinations d ON t.destination_id = d.id
            LEFT JOIN accommodation a ON a.destination_id = d.id
            ORDER BY t.departure ASC
        ");
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Csoportosítás trip_id alapján (hogy egy triphez több szállás legyen)
        $groupedTrips = [];
    
        foreach ($results as $row) {
            $tripId = $row['id'];
    
            if (!isset($groupedTrips[$tripId])) {
                $groupedTrips[$tripId] = [
                    'id' => $row['id'],
                    'departure' => $row['departure'],
                    'arrival' => $row['arrival'],
                    'price_per_person' => $row['price_per_person'],
                    'available_spots' => $row['available_spots'],
                    'image_url' => $row['image_url'],
                    'short_description' => $row['short_description'],
                    'full_description' => $row['full_description'],
                    'destination_id' => $row['destination_id'],
                    'destination' => $row['destination'],
                    'city' => $row['city'],
                    'country' => $row['country'],
                    'accommodations' => []
                ];
            }
    
            // Ha van szállás hozzárendelve
            if ($row['accommodation_id']) {
                $groupedTrips[$tripId]['accommodations'][] = [
                    'id' => $row['accommodation_id'],
                    'name_of_accommoda' => $row['name_of_accommoda'],
                    'address' => $row['address'],
                    'rating' => $row['rating'],
                    'price_per_night_per_per' => $row['price_per_night_per_per'],
                    'destination_id' => $row['accommodation_destination_id']
                ];
            }
        }
    
        return array_values($groupedTrips);
    }
    public function getLimitedTrips($limit = 3) {
        $stmt = $this->pdo->prepare("
            SELECT 
                t.*,
                d.destination, d.city, d.country,
                a.id AS accommodation_id, 
                a.name_of_accommoda, 
                a.address, 
                a.rating, 
                a.price_per_night_per_per,
                a.destination_id AS accommodation_destination_id
            FROM trips t
            JOIN destinations d ON t.destination_id = d.id
            LEFT JOIN accommodation a ON a.destination_id = d.id
            ORDER BY t.departure ASC
            LIMIT ?
        ");
    
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // ugyanaz a csoportosítás mint az előzőben
        $groupedTrips = [];
    
        foreach ($results as $row) {
            $tripId = $row['id'];
    
            if (!isset($groupedTrips[$tripId])) {
                $groupedTrips[$tripId] = [
                    'id' => $row['id'],
                    'departure' => $row['departure'],
                    'arrival' => $row['arrival'],
                    'price_per_person' => $row['price_per_person'],
                    'available_spots' => $row['available_spots'],
                    'image_url' => $row['image_url'],
                    'short_description' => $row['short_description'],
                    'full_description' => $row['full_description'],
                    'destination_id' => $row['destination_id'],
                    'destination' => $row['destination'],
                    'city' => $row['city'],
                    'country' => $row['country'],
                    'accommodations' => []
                ];
            }
    
            if ($row['accommodation_id']) {
                $groupedTrips[$tripId]['accommodations'][] = [
                    'id' => $row['accommodation_id'],
                    'name_of_accommoda' => $row['name_of_accommoda'],
                    'address' => $row['address'],
                    'rating' => $row['rating'],
                    'price_per_night_per_per' => $row['price_per_night_per_per'],
                    'destination_id' => $row['accommodation_destination_id']
                ];
            }
        }
    
        return array_values($groupedTrips);
    }
        
}

?> 
