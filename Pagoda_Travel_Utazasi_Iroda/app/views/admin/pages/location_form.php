<!--
<h2>Új úticél és szállás</h2>
<form method="post">
    <label>Hely neve:</label>
    <input type="text" name="destination" required>

    <label>Város:</label>
    <input type="text" name="city" required>

    <label>Ország:</label>
    <input type="text" name="country" required>

    <hr>

    <label>Szállás neve:</label>
    <input type="text" name="name_of_accommoda" required>

    <label>Ár / éj / fő:</label>
    <input type="number" name="price_per_night_per_per" required>

    <button type="submit" name="save_location">Mentés</button>
</form>
-->
<h2>Új szállás felvitele</h2>

<form method="post">
    <label>Szállás neve:</label>
    <input type="text" name="name_of_accommoda" required>

    <label>Ár / éj / fő:</label>
    <input type="number" name="price_per_night_per_per" required>

    <label>Úticél (ország/város):</label>
    <select name="destination_id" required>
        <?php foreach ($destinations as $dest): ?>
            <option value="<?php echo $dest['id']; ?>">
                <?php echo htmlspecialchars($dest['destination']) . " – " . htmlspecialchars($dest['city']) . " (" . htmlspecialchars($dest['country']) . ")"; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit" name="add_accommodation">Mentés</button>
</form>
