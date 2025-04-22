<?php require __DIR__ . '/../partials/header.php'; ?>
<?php
echo "<pre>Trip count: " . count($trips) . "</pre>";
?>
<h1>Elérhető Utazások</h1>

<?php
// Megjeleníti az utazásokat teljes foglalási űrlappal
$showBookingForm = true;
include __DIR__ . '/../components/trip_card.php';
?>

<?php require __DIR__ . '/../partials/footer.php'; ?>
