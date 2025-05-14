<?php
require_once __DIR__ . '/../models/Accommodation.php';
$admin = new AdminController();
$admin->addTrip($pdo);
$admin->addAccommodation($pdo); 


class Admin {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
        $stmt->execute([$username, hash('sha256', $password)]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
