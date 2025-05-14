<!--BookingController feldolgozza a foglalási űrlapot (store) és listázza a felhasználó foglalásait (listUserBookings).-->

<?php

require_once __DIR__ . '/../models/Booking.php';
//tovább fejlesztettem!
//most már ellenőrzi hogy a kiválasztott trip_id és accommodation_id ugyanarra a destination_id-re mutatnak-e.
//Ezzel az ellenőrzéssel akkor is elutasításra kerül a foglalás, ha valaki a HTML-t manipulálná 
// vagy JavaScript-ben rossz options-t állítana be manuálisan.
class BookingController {
    public function store($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_trip'])) {
            if (!isset($_SESSION['user_id'])) {
                die("Kérlek, jelentkezz be a foglaláshoz!");
            }
    
            $tripId = $_POST['trip_id'];
            $accId = $_POST['accommodation_id'];
            $passengers = $_POST['number_of_passengers'];
    
            //Ellenőrizzük, hogy a szállás az utazás desztinációjához tartozik-e:
            $stmt = $pdo->prepare("SELECT destination_id FROM trips WHERE id = ?");
            $stmt->execute([$tripId]);
            $tripDest = $stmt->fetchColumn();
    
            $stmt = $pdo->prepare("SELECT destination_id FROM accommodation WHERE id = ?");
            $stmt->execute([$accId]);
            $accDest = $stmt->fetchColumn();
    
            if ($tripDest != $accDest) {
                echo "<p style='color:red;'>⚠️ A kiválasztott szállás nem tartozik az utazás úticéljához!</p>";
                return;
            }
    
            // Ha minden rendben akkor tud foglalni
            $model = new Booking($pdo);
            $success = $model->create(
                $_SESSION['user_id'],
                $tripId,
                $accId,
                $passengers
            );
    
            if ($success) { //megvizsgáljuk hogy sikeres volt e a foglalás tehát tru vagy false
                if (!headers_sent()) {
                    header("Location: /booking"); //kimenet nélküli átirányítás, szerver oldal
                    exit();
                } else { 
                    echo "<script>window.location.href = '/booking';</script>"; //böngésző oldali átirányítás
                    exit();
                }
            } else {
                echo "<p style='color:red;'>Hiba történt a foglaláskor.</p>"; //egyszerű hibaüzenet, ha nem sikerült a foglalás
            }
        }
    }
    
    public function listUserBookings($pdo) {
        if (!isset($_SESSION['user_id'])) {
            die("Kérlek, jelentkezz be.");
        }

        $model = new Booking($pdo);
        $bookings = $model->getByUser($_SESSION['user_id']);

        // View betöltése
        //require __DIR__ . '/../views/bookings/list.php'; //előzőleg ezt használtam, de a másik form szebb, ezt tartalékban marad
        require __DIR__ . '/../views/bookings/user_booking.php';

    }
}
