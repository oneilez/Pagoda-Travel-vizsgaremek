
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Pagoda travel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/layout.css">
    <link rel="stylesheet" href="style/cards.css">
    <link rel="stylesheet" href="style/feedback.css">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/responsive.css">
    <link rel="stylesheet" href="style/modal.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/trip.css">
    <link rel="stylesheet" href="style/authmodal.css">
    <link rel="stylesheet" href="style/tripmodal.css">
    <link rel="stylesheet" href="style/logo.css">
     <!--<link rel="stylesheet" href="style/admin.css">-->
    <link rel="stylesheet" href="style/contact.css">


    <!--<link rel="stylesheet" href="style/description.css">-->
    <!--<link rel="stylesheet" href="styles.css">-->
    <script defer src="js/navbar.js"></script> <!-- biztosítja hogy a dom után töltődjön be a script fájl!!!!! -->
    <script defer src="js/authmodal.js"></script>
    <script defer src="js/tripmodal.js"></script>
    <!--<script defer src="js/admin.js"></script>-->
   
    
</head>
<body>
<!--
<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-logo">Utazási Iroda</div>
        <ul class="navbar-links">
            <li><a href="index.php">Főoldal</a></li>
            <li><a href="/login.php">Bejelentkezés / Regisztráció</a></li>
            <li><a href="/kapcsolat.php">Kapcsolat</a></li>
        </ul>
    </div>
</nav>

<div class="container">
-->

<nav class="navbar">
    <div class="navbar-container">
    <div class="navbar-logo">
    <a href="/" class="logo-link">
    <img src="/uploads/logo.png" alt="Pagoda travel" class="logo-img">
    <span class="navbar-logo-text">Pagoda travel</span>
    </a>
    </div>


        <!-- Hamburger ikon mobilra -->
        <div class="navbar-toggle" id="mobile-menu">☰</div>

        <!-- Menü -->
        <div class="navbar-right">
            <ul class="navbar-links" id="navbar-links">
                <li><a href="/index">Főoldal</a></li>
                <li><a href="#" id="openAuthModal" class="loginbtn">Bejelentkezés / Regisztráció</a></li>
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


 <!-- Logó és felirat -->
        <!-- <div class="navbar-logo">
            <a href="/">
                <img src="/uploads/logo.png" alt="Utazási Iroda logó">
            </a>
            <span class="navbar-logo-text">Utazási Iroda</span>
        </div>-->
