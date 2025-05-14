
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Pagoda travel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/layout.css">
    <link rel="stylesheet" href="style/cards.css">
    <link rel="stylesheet" href="style/feedback.css">
    <link rel="stylesheet" href="style/logos.css">
    <link rel="stylesheet" href="style/navbars.css">
    <link rel="stylesheet" href="style/responsive.css">
    <link rel="stylesheet" href="style/modal.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/trip.css">
    <link rel="stylesheet" href="style/authmodal.css">
    <link rel="stylesheet" href="style/tripmodal.css">
    <link rel="stylesheet" href="style/trip_details_modal.css">
    
    <link rel="stylesheet" href="style/contact.css">

    <script defer src="js/navbar.js"></script> <!-- a defer kifejezés biztosítja hogy a dom után töltődjön be a script fájl!!!!! -->
    <script defer src="js/authmodal.js"></script>
    <script defer src="js/tripmodals.js"></script>
   
    
</head>
<body>
<nav class="navbar">
    <div class="navbar-container">

        <!-- BAL OLDAL: Logó + felirat -->
        <div class="navbar-left">
            <a href="/" class="logo-link">
                <img src="uploads/logo.png" alt="Pagoda travel" class="logo-img">
                <span class="navbar-logo-text">Pagoda travel</span>
            </a>
        </div>

        <!-- MOBIL HAMBURGER -->
        <div class="navbar-toggle" id="mobile-menu">☰</div>

        <!-- JOBB OLDAL: Menü + gomb -->
        <div class="navbar-right">
            <ul class="navbar-links" id="navbar-links">
                <li><a href="/index">Főoldal</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="#" id="openAuthModal" class="loginbtn">Bejelentkezés / Regisztráció</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/booking">Foglalásaim</a></li>
                <?php endif; ?>
                <li><a href="/trips">Utazások</a></li>
                <li><a href="/contact">Kapcsolat</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>
                        <form method="post">
                            <button type="submit" name="logout" class="logout-btn">Kijelentkezés</button>
                        </form>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

    </div>
</nav>

