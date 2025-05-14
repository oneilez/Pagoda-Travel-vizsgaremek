<?php
class Accommodation {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    
    public function add($name, $price, $destination_id) {
        $stmt = $this->pdo->prepare("INSERT INTO accommodation (name_of_accommoda, price_per_night_per_per, destination_id) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $price, $destination_id]);
    }
    

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM accommodation");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
