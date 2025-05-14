<?php require __DIR__ . '/../partials/header.php'; ?>
<h2>Admin bejelentkezés</h2>
<form method="post">
    <label>Felhasználónév:</label>
    <input type="text" name="username" required><br>
    <label>Jelszó:</label>
    <input type="password" name="password" required><br>
    <button type="submit" name="admin_login">Bejelentkezés</button>
</form>
<?php require __DIR__ . '/../partials/footer.php'; ?>