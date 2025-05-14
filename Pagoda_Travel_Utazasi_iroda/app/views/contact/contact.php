<?php
require __DIR__ . '/../partials/header.php';


?>

<h2>Kapcsolat</h2>

<form method="post" action="" class="contact-form">
    <label for="name">Név:</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Email cím:</label>
    <input type="email" name="email" id="email" required>

    <label for="message">Üzenet:</label>
    <textarea name="message" id="message" rows="5" required></textarea>

    <button type="submit" name="send_message">Üzenet küldése</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    // Adatok beolvasása és előkészítése
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    $errors = [];

    // VALIDÁCIÓK

    // 1. Üres mezők ellenőrzése
    if (empty($name) || empty($email) || empty($message)) {
        $errors[] = "Kérlek, tölts ki minden mezőt!";
    }

    // 2. Email ellenőrzés
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Kérlek, adj meg érvényes email címet!";
    }

    // 3. Név formátum ellenőrzése
    if (!preg_match("/^[a-zA-ZáéíóöőúüűÁÉÍÓÖŐÚÜŰ ]+$/u", $name)) {
        $errors[] = "A név csak betűket és szóközöket tartalmazhat!";
    }

    // 4. Üzenet hossz ellenőrzése
    if (strlen($message) > 1000) {
        $errors[] = "Az üzenet legfeljebb 1000 karakter hosszú lehet.";
    }

    // 5.HTML kód eltávolítás XSS védelemre
    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $message = htmlspecialchars($message);

    // HIBÁK KIÍRÁSA vagy ADATBÁZISBA MENTÉS
    if (!empty($errors)) {
        echo "<ul style='color: red; margin-top: 20px;'>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    } else {
        $stmt = $pdo->prepare("INSERT INTO contact_messages (user_id, name, email, message) VALUES (?, ?, ?, ?)");
        $success = $stmt->execute([$user_id, $name, $email, $message]);

        if ($success) {
            echo "<p style='color: green; margin-top: 20px;'>Köszönjük, {$name}! Üzenetedet elmentettük.</p>";
        } else {
            echo "<p style='color: red; margin-top: 20px;'>Hiba történt az üzenet mentésekor.</p>";
        }
    }
}
?>

<?php require __DIR__ . '/../partials/footer.php'; ?>
