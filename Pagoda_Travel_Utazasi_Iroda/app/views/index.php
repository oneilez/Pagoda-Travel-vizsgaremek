<?php require __DIR__ . '/partials/header.php'; ?>

<h1>Üdvözöl a Pagoda Travel utazási iroda</h1>
<h2>Ajánlott utazásaink</h2>

<?php
$showBookingForm = false; // főoldalon nincs foglalás ha false akkor a foglalás gomb nincs, ha true akkor van
include __DIR__ . '/components/trip_card.php';
?>

<!-- Modal háttér - Login/Register -->
<div class="auth-modal" id="authModal">
  <div class="auth-modal-content">
    <span class="close">&times;</span>
    <h2>Bejelentkezés / Regisztráció</h2>
    <form method="post">
        <label for="email">E-mail:</label>
        <input type="email" name="email" required><br>
        <label for="password">Jelszó:</label>
        <input type="password" name="password" required><br>
        <button type="submit" name="login">Bejelentkezés</button>
    </form>
    <hr>
    <form method="post">
        <label for="name">Név:</label>
        <input type="text" name="name" required><br>
        <label for="email">E-mail:</label>
        <input type="email" name="email" required><br>
        <label for="password">Jelszó:</label>
        <input type="password" name="password" required><br>
        <button type="submit" name="register">Regisztráció</button>
    </form>
  </div>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
