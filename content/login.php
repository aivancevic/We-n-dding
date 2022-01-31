<script defer src="./assets/js/login_error_handling.js"></script>

<section class="login-container">
    <div class="login-section">
        <div class="login-box">
            <form id="login_form"action="./system/login/includes/login.inc.php" method="post">
                <span>Korisničko ime:</span>
                <input type="text" name="uid" id="username" class="input-username" placeholder="Korisničko ime" required>
                <span>Lozinka:</span>
                <input type="password" name="pwd" id="password" class="input-password" placeholder="Lozinka" required>
                <small class="error_small"></small>
                <button type="submit" name="submit" class="input-btn">PRIJAVA</button>
                
            </form>
            <p>Ukoliko nemate korisnički račun <a class="register" href="?page=registracija">Registrirajte se ovdje</a></p>
        </div>
    </div> 
</section>