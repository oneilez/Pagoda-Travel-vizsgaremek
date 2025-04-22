<?php
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/Accommodation.php';
require_once __DIR__ . '/../models/Booking.php';

class AdminController {
    public function loginPage() {
        require __DIR__ . '/../views/admin/login.php';
    }
    //sima admin bejelentkezése
    public function login($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $adminModel = new Admin($pdo);
            $admin = $adminModel->login($username, $password);

            if ($admin) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_name'] = $admin['username'];
                header("Location: admin.php");
                exit();
            } else {
                echo "Hibás belépési adatok!";
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: admin.php");
        exit();
    }

    public function dashboard($pdo) {
        $stmt = $pdo->query("SELECT * FROM destinations");
        $destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!isset($_SESSION['admin_id'])) {
            header("Location: admin.php");
            exit();
        }

        // Foglalások lekérdezése
        $stmt = $pdo->query("SELECT b.*, c.name AS client_name, t.departure, t.arrival, 
                    d.destination, d.city, d.country, a.name_of_accommoda
             FROM bookings b
             JOIN clients c ON b.clients_id = c.id
             JOIN trips t ON b.trips_id = t.id
             JOIN destinations d ON t.destination_id = d.id
             JOIN accommodation a ON b.accommodation_id = a.id");

        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../views/admin/dashboard.php';
    }

    /*public function addTrip($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_trip'])) {
            $departure = $_POST['departure'];
            $arrival = $_POST['arrival'];
            $price = $_POST['price_per_person'];

            $destination_id = $_POST['destination_id'];
            $stmt = $pdo->prepare("INSERT INTO trips (departure, arrival, price_per_person, destination_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$departure, $arrival, $price, $destination_id]);


            header("Location: admin.php");
            exit();
        }
    }*/
    public function addTrip($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_trip'])) {
            $departure = $_POST['departure'];
            $arrival = $_POST['arrival'];
            $price = $_POST['price_per_person'];
            $available = $_POST['available_spots'];
            $destination_id = $_POST['destination_id'];
            $short_description = $_POST['short_description'];
            $full_description = $_POST['full_description'];
    
            // Kép feltöltése
            $image_path = null;
            if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['image_path']['tmp_name'];
                $original_name = basename($_FILES['image_path']['name']);
                $upload_path = 'uploads/' . time() . '_' . $original_name;
    
                if (move_uploaded_file($tmp_name, $upload_path)) {
                    $image_path = $upload_path;
                }
            }
    
            // Adatbázisba beszúrás
            $stmt = $pdo->prepare("INSERT INTO trips (departure, arrival, price_per_person, available_spots, destination_id, image_url, short_description, full_description)
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
            $stmt->execute([
                $departure,
                $arrival,
                $price,
                $available,
                $destination_id,
                $image_path,
                $short_description,
                $full_description
            ]);
    
            header("Location: admin.php?page=trip_form");
            exit();
        }
    }
    

    public function addAccommodation($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_accommodation'])) {
            $accModel = new Accommodation($pdo);
            $accModel->add(
                $_POST['name_of_accommoda'], 
                $_POST['price_per_night_per_per'],
                $_POST['destination_id']
            );
    
            header("Location: admin.php?page=location_form");
            exit();
        }
    }
    
    /*public function addAccommodation($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_accommodation'])) {
            $accModel = new Accommodation($pdo);
            $accModel->add($_POST['name_of_accommoda'], $_POST['price_per_night_per_per']);
            header("Location: admin.php");
            exit();
        }
    }*/

    public function deleteBooking($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_booking'])) {
            $id = $_POST['booking_id'];
            $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
            $stmt->execute([$id]);
            header("Location: admin.php");
            exit();
        }
    }

    public function addDestination($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_destination'])) {
            $destination = $_POST['destination'];
            $city = $_POST['city'];
            $country = $_POST['country'];
    
            $stmt = $pdo->prepare("INSERT INTO destinations (destination, city, country) VALUES (?, ?, ?)");
            $stmt->execute([$destination, $city, $country]);
    
            header("Location: admin.php");
            exit();
        }
    }
    public function getAllBookings($pdo)
{
    $stmt = $pdo->query("
        SELECT b.*, c.name AS client_name, 
               t.price_per_person, t.departure, t.arrival,
               d.destination, d.city, d.country,
               a.name_of_accommoda
        FROM bookings b
        JOIN clients c ON b.clients_id = c.id
        JOIN trips t ON b.trips_id = t.id
        JOIN destinations d ON t.destination_id = d.id
        JOIN accommodation a ON b.accommodation_id = a.id
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    //a felhasználók kilistázásához használom az admin/user aloldalon
    public function users($pdo) {
        $stmt = $pdo->query("SELECT * FROM clients");  // vagy users táblából
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require __DIR__ . '/../views/admin/pages/users.php';
    }
    public function deleteUser($pdo) {
        if (isset($_POST['user_id'])) {
            $id = $_POST['user_id'];
            $stmt = $pdo->prepare("DELETE FROM clients WHERE id = ?");
            $stmt->execute([$id]);
            header("Location: admin.php?page=users");
            exit();
        }
    }
    
    // app/controllers/AdminController.php
public function getAllMessages($pdo) {
    $stmt = $pdo->query("SELECT contact_messages.*, clients.name AS user_name 
                         FROM contact_messages 
                         LEFT JOIN clients ON contact_messages.user_id = clients.id 
                         ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function deleteMessage($pdo) {
    if (isset($_POST['delete_message_id'])) {
        $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = ?");
        $stmt->execute([$_POST['delete_message_id']]);
        header("Location: admin.php?page=messages");
        exit();
    }
}

}
?>
