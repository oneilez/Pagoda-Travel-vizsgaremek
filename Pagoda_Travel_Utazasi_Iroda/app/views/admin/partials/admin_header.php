<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Admin – Pagoda Travel</title>
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="style/admin_table.css">
    <script defer src="js/admin.js"></script>
</head>
<body>

<div class="admin-container">
    <aside class="admin-sidebar">
        <h3>Admin Menü</h3>
        <ul>
            <li><a href="admin.php?page=bookings">📑Foglalások</a></li>
            <li><a href="admin.php?page=trip_form">✈️Új utazás</a></li>
            <li><a href="admin.php?page=users">👥Felhasználók</a></li>
            <li><a href="admin.php?page=location_form">📍Úticélok / Szállások</a></li>
            <li><a href="admin.php?page=messages">📬Üzenetek</a></li>

        </ul>
        <form method="post" style="margin-top: 20px;">
            <button type="submit" name="admin_logout">Kijelentkezés</button>
        </form>
    </aside>
    <main class="admin-content">

<!--<div class="admin-sidebar">
    <h3>Admin Menü</h3>
    <ul>
        <li><a href="dashboard.php?page=bookings">📑 Foglalások</a></li>
        <li><a href="dashboard.php?page=trip_form">✈️ Új utazás</a></li>
        <li><a href="dashboard.php?page=users">👥 Felhasználók</a></li>
        <li><a href="dashboard.php?page=location_form">📍 Új úticél / szállás</a></li>
    </ul>
</div>
-->