<h2>Új utazás felvétele</h2>

<form method="post" enctype="multipart/form-data">
    <label for="departure">Indulás:</label>
    <input type="date" name="departure" required>

    <label for="arrival">Érkezés:</label>
    <input type="date" name="arrival" required>

    <label for="price_per_person">Ár / fő:</label>
    <input type="number" name="price_per_person" required>

    <label for="available_spots">Elérhető férőhelyek:</label>
    <input type="number" name="available_spots" min="1" value="10" required>

    <label for="destination_id">Úticél:</label>
    <select name="destination_id" required>
        <?php foreach ($destinations as $dest): ?>
            <option value="<?php echo $dest['id']; ?>">
                <?php echo htmlspecialchars($dest['destination'] . " – " . $dest['city'] . ", " . $dest['country']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="image_path">Kép feltöltése:</label>
    <input type="file" name="image_path" accept="image/*">

    <label for="short_description">Rövid leírás:</label>
    <textarea name="short_description" rows="3" required></textarea>

    <label for="full_description">Teljes leírás:</label>
    <textarea name="full_description" rows="5"></textarea>

    <button type="submit" name="add_trip">Mentés</button>
</form>
