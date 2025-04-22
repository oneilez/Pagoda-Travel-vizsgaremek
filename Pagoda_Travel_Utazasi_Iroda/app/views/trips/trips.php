<?php require __DIR__ . '/../partials/header.php'; ?>

<?php



require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/models/Trip.php';

public function getLimitedTrips($limit = 3) {
    $stmt = $this->pdo->prepare("SELECT * FROM trips LIMIT ?");
    $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
require __DIR__ . '/../views/trips/index.php'; 
?>



<?php require __DIR__ . '/../partials/header.php'; ?>