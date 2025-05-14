<?php
session_start();

require_once __DIR__ . '/../config/database.php';

// Controllerek betöltése
require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/TripController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/BookingController.php';


$homeController = new HomeController();
$tripController = new TripController();
$auth = new AuthController();
$bookingController = new BookingController();

// Aktuális útvonal lekérése
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


//innen az útvonalból még hiányzik az admin felület útvonala és a booking, azokat még sima .php oldal nyitja meg
// Egyszerű útválasztás
switch ($path) {
    case '/':
    case '/index':
    case '/index.php':
        $auth->handleRequest($pdo); // login, regi
        $homeController->index($pdo); // csak 3 utazás a főoldalra
        break;

    case '/trips':
        $auth->handleRequest($pdo); // login, regi
        $tripController->index($pdo); // minden utazás listázva
        break;

    case '/book':
        //foglalási űrlap feldolgozása
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingController->store($pdo); // foglalás
        }
        break;
    case '/booking':
        $auth->handleRequest($pdo); // bejelentkezés ellenőrzése
        $bookingController->listUserBookings($pdo);
        break;

    case '/contact':
        require __DIR__ . '/../app/views/contact/contact.php';
        break;

    case '/admin':
        //$admin->loginPage();
        //require_once __DIR__ . '/../admin.php';
        break;

    case '/logout':
        $auth->logout();
        break;

    default:
        http_response_code(404);
        require_once  __DIR__ . '/../app/views/errors/404.php';
        break;
}
