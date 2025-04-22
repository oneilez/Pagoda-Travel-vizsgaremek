<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-logo">Utazási Iroda</div>

         <!-- BAL OLDAL: LOGÓ -->
        

        <!-- Hamburger ikon -->
        <div class="navbar-toggle" id="mobile-menu">
            ☰
        </div>

        <!-- Menüpontok -->
         
        <!-- JOBB OLDAL: MENÜK ÉS KIJELENTKEZÉS -->
    <div class="navbar-right">
      <ul class="navbar-links" id="navbar-links">
        <li><a href="/index">Főoldal</a></li>
        <li><a href="#" id="openAuthModal" class="loginbtn">Bejelentkezés / Regisztráció</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
          <li><a href="booking.php">Foglalásaim</a></li>
        <?php endif; ?>
        <li><a href="/trips">Utazások</a></li>
        <li><a href="/contact">Kapcsolat</a></li>
      
      <li>
      <?php if (isset($_SESSION['user_id'])): ?>
        <form method="post">
          <button type="submit" name="logout" class="logout-btn">Kijelentkezés</button>
        </form>
        </li>
      <?php endif; ?>
      </ul>
    </div>

  </div>
</nav>