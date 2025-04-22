<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/TripController.php';
require_once __DIR__ . '/../app/models/Destination.php';

$admin = new AdminController();
//$tripController = new TripController();

// POST kérések kezelése
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['admin_login'])) {
        $admin->login($pdo);
    } elseif (isset($_POST['admin_logout'])) {
        $admin->logout();
    } elseif (isset($_POST['delete_booking'])) {
        $admin->deleteBooking($pdo);
    } elseif (isset($_POST['add_trip'])) {
        $tripController->store($pdo); // javítva!
    } elseif (isset($_POST['add_accommodation'])) {
        $admin->addAccommodation($pdo);
    } elseif (isset($_POST['add_destination'])) {
        $admin->addDestination($pdo);
    } elseif (isset($_POST['delete_user'])) {
        $admin->deleteUser($pdo);
    }elseif (isset($_POST['delete_message'])) {
        $admin->deleteMessage($pdo);
    }
}

if (!isset($_SESSION['admin_id'])) {
    $admin->loginPage();
    exit();
}

require __DIR__ . '/../app/views/admin/partials/admin_header.php';

$page = $_GET['page'] ?? 'bookings';

switch ($page) {
    case 'trip_form':
        $destinationModel = new Destination($pdo);
        $destinations = $destinationModel->getAll();
        require __DIR__ . '/../app/views/admin/pages/trip_form.php';
        break;

    case 'location_form':
        $stmt = $pdo->query("SELECT * FROM destinations");
        $destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require __DIR__ . '/../app/views/admin/pages/location_form.php';
        break;

    case 'users':
        $admin->users($pdo);
        break;

    case 'bookings':
    default:
        $bookings = $admin->getAllBookings($pdo);
        require __DIR__ . '/../app/views/admin/pages/bookings.php';
        break;
    case 'messages':
        $messages = $admin->getAllMessages($pdo);
        require __DIR__ . '/../app/views/admin/pages/messages.php';
        break;
}

require __DIR__ . '/../app/views/admin/partials/admin_footer.php';
?>