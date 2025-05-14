

<h1>Foglalások</h1>

<?php foreach ($bookings as $booking): ?>
    <div class="booking-item">
        <strong><?php echo htmlspecialchars($booking['client_name']); ?></strong> foglalt 
        <?php echo htmlspecialchars($booking['number_of_passengers']); ?> fő részére<br>
        Útra: <?php echo htmlspecialchars($booking['destination']); ?> – 
        <?php echo htmlspecialchars($booking['city']); ?>, 
        <?php echo htmlspecialchars($booking['country']); ?><br>
        Dátum: <?php echo htmlspecialchars($booking['booking_date']); ?> – 
        Ár: <?php echo number_format($booking['total_price'], 0, ',', ' '); ?> Ft<br>
        Szállás: <?php echo htmlspecialchars($booking['name_of_accommoda']); ?>
        <form method="post">
            <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
            <button type="submit" name="delete_booking">Törlés</button>
        </form>
    </div>
<?php endforeach; ?>


