
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
