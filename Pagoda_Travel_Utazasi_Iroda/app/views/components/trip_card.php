<div class="trips-list">
<?php if (!isset($trips) || !is_array($trips) || count($trips) === 0): ?>
    <p>Nincs elérhető utazás jelenleg.</p>
<?php else: ?>
    <?php foreach ($trips as $trip): ?>
        <div class="trip-container">
            <img src="/uploads/<?php echo htmlspecialchars($trip['image_url']); ?>" 
                 alt="Utazás képe" 
                 style="width: 100%; border-radius: 8px; max-height: 200px; object-fit: cover;">

            <h3>
                <?php echo htmlspecialchars($trip['destination']); ?>
                <br>
                <small>(<?php echo htmlspecialchars($trip['city']); ?>, <?php echo htmlspecialchars($trip['country']); ?>)</small>
            </h3>
            <?php
            $departure = date('Y. m. d.', strtotime($trip['departure']));
            $arrival = date('Y. m. d.', strtotime($trip['arrival']));
            ?>
            <p><strong>Indulás:</strong> <?= $departure ?><br>
            <strong>Érkezés:</strong> <?= $arrival ?></p>
            

            <button class="details-btn" 
                data-trip='<?php echo json_encode($trip["full_description"], JSON_HEX_APOS | JSON_HEX_QUOT); ?>'>
                Részletek
            </button>

            <p><em><?php echo nl2br(htmlspecialchars($trip['short_description'])); ?></em></p>

            <?php if (!empty($showBookingForm) && isset($_SESSION['user_id'])): ?>
                <form method="post" action="/book">
                    <input type="hidden" name="trip_id" value="<?php echo $trip['id']; ?>">
            <!--ha a trip['accommodations'] nincs beállítva, vagy nem tömb, csak akkor próbálja meg végigiterálni, ha tényleg van benne adat. -->
                    <label>Szállás:</label>
                    <select name="accommodation_id" required>
                    <?php if (isset($trip['accommodations']) && is_array($trip['accommodations']) && count($trip['accommodations']) > 0): ?>
                            <?php foreach ($trip['accommodations'] as $acc): ?>
                                <option value="<?php echo $acc['id']; ?>">
                                    <?php echo htmlspecialchars($acc['name_of_accommoda']); ?> –
                                    <?php echo number_format($acc['price_per_night_per_per'], 0, ',', ' '); ?> Ft/éj
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option disabled>Nincs elérhető szállás</option>
                        <?php endif; ?>
                    </select>

                    
                    <label>Utasok száma:</label>
                    <input type="number" name="number_of_passengers" min="1" max="<?php echo (int)$trip['available_spots']; ?>" required>
                    <small>Max. férőhely: <?php echo $trip['available_spots']; ?> fő</small>

                    <!--<label>Utasok száma:</label>
                    <input type="number" name="number_of_passengers" min="1" required>-->

                    <button type="submit" name="book_trip">Foglalás</button>
                </form>
            <?php elseif (!empty($showBookingForm)): ?>
                <p><strong>Bejelentkezés szükséges a foglaláshoz!</strong></p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>
<!-- 
A foglalási űrlap csak bejelentkezett felhasználóknál jelenik meg, és a foglalás trip_id-hez kötődik.
 -->