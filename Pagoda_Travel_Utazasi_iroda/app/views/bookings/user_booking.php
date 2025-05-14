<?php require __DIR__ . '/../partials/header.php'; ?>
<h1>Foglalásaim</h1>

<div class="trips-list">
<?php if (empty($bookings)): ?>
    <p>Még nincs foglalásod.</p>
<?php else: ?>
    <?php foreach ($bookings as $booking): ?>
        <div class="trip-container">
            <h3><?php echo htmlspecialchars($booking['destination']); ?> (<?php echo htmlspecialchars($booking['city']); ?>, <?php echo htmlspecialchars($booking['country']); ?>)</h3>
            <p>📅 <?php echo htmlspecialchars($booking['departure']); ?> – <?php echo htmlspecialchars($booking['arrival']); ?></p>
            <p>👤 Utasok száma: <?php echo $booking['number_of_passengers']; ?></p>
            <p>💰 Összes ár: <?php echo number_format($booking['total_price'], 0, ',', ' '); ?> Ft</p>
            <p>🏨 Szállás: <?php echo htmlspecialchars($booking['name_of_accommoda']); ?></p>
            <p>🗓 Foglalás dátuma: <?php echo $booking['booking_date']; ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>
<?php require __DIR__ . '/../partials/footer.php'; ?>
