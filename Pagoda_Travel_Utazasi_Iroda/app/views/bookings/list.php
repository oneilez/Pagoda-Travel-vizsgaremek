<?php require __DIR__ . '/../partials/header.php'; ?>
<!-- Csak akkor kell majd ha egyszerűbb lista nézetben jeleníteném meg a foglalásokat, talán egy kisebb összegzésben a baloldalon
 vagy máshol, még tervezés alatt. A dizjnos foglalás a user_booking.php tartalmazza -->
<h2>Foglalásaid</h2>

<?php if (!empty($bookings)): ?>
    <ul>
        <?php foreach ($bookings as $b): ?>
            <li>
                <?php echo $b['departure']; ?> → <?php echo $b['arrival']; ?> |
                Szállás: <?php echo $b['name_of_accommoda']; ?> |
                Utasok: <?php echo $b['number_of_passengers']; ?> |
                Ár: <?php echo number_format($b['total_price'], 0, ',', ' '); ?> Ft
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Nincs foglalásod.</p>
<?php endif; ?>
<?php require __DIR__ . '/../partials/footer.php'; ?>