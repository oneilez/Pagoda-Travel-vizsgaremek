


<h2>Kapcsolati üzenetek</h2>

<?php if (count($messages) === 0): ?>
    <p>Nincs üzenet.</p>
<?php else: ?>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Név</th>
                <th>Email</th>
                <th>Üzenet</th>
                <th>Dátum</th>
                <th>Művelet</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $msg): ?>
                <tr>
                    <td><?php echo htmlspecialchars($msg['name']); ?></td>
                    <td><?php echo htmlspecialchars($msg['email']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($msg['message'])); ?></td>
                    <td><?php echo $msg['created_at']; ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="delete_message_id" value="<?php echo $msg['id']; ?>">
                            <button type="submit" name="delete_message" onclick="return confirm('Biztosan törlöd?');">Törlés</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>


