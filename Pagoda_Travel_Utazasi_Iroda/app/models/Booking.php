
<!--Booking model kezeli a foglalás mentését és lekérdezését.-->
<?php
class Booking {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($client_id, $trip_id, $accommodation_id, $num_passengers) {
        $booking_date = date('Y-m-d');

        // Lekérdezzük az árakat
        $stmt = $this->pdo->prepare("SELECT price_per_person FROM trips WHERE id = ?");
        $stmt->execute([$trip_id]);
        $trip_price = $stmt->fetchColumn();

        $stmt = $this->pdo->prepare("SELECT price_per_night_per_per FROM accommodation WHERE id = ?");
        $stmt->execute([$accommodation_id]);
        $acc_price = $stmt->fetchColumn();

        $total = ($trip_price + $acc_price) * $num_passengers;

        $stmt = $this->pdo->prepare("INSERT INTO bookings (clients_id, trips_id, accommodation_id, booking_date, number_of_passengers, total_price)
                                     VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$client_id, $trip_id, $accommodation_id, $booking_date, $num_passengers, $total]);
    }

    /*public function getByUser($user_id) {
        $stmt = $this->pdo->prepare("SELECT b.*, t.departure, t.arrival, a.name_of_accommoda 
                                     FROM bookings b
                                     JOIN trips t ON b.trips_id = t.id
                                     JOIN accommodation a ON b.accommodation_id = a.id
                                     WHERE b.clients_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }*/
    public function getByUser($user_id) {
        $stmt = $this->pdo->prepare("
            SELECT b.*, 
                   t.departure, t.arrival, 
                   d.destination, d.city, d.country,
                   a.name_of_accommoda 
            FROM bookings b
            JOIN trips t ON b.trips_id = t.id
            JOIN destinations d ON t.destination_id = d.id
            JOIN accommodation a ON b.accommodation_id = a.id
            WHERE b.clients_id = ?
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // SELECT b.*, -azaz az összes oszlop kiválasztása a booking táblából! ne felejtsem el hogy aliast használtam!!!!!!
}
?>