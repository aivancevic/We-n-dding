<script defer src="./assets/js/registracija_error_handling.js"></script>

<?php 
    include "./system/drzaveGradovi/drzaveGradovi.inc.php";
?>

<div class="registration-conainer registration-conainer-height">
    <div class="container">
        <div class="title">Registracija</div>
        <div class="content">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <form class="register-form" action="./system/login/includes/signup.inc.php" method="post">
            <div class="tip-profila">
            <input type="radio" name="tip-profila" id="dot-1" value="korisnik-usluge">
            <input type="radio" name="tip-profila" id="dot-2" value="pruzatelj-usluge">
            <span class="type-of-user-title">Odaberite tip korisničkog profila</span>
            <div class="category">
            <label class="lable-for-dot-1" for="dot-1">
                <span class="dot one" name="korisnik"></span>
                <span class="type-of-user">Korisnik usluge</span>
            </label>
            <label class="lable-for-dot-2" for="dot-2">
                <span class="dot two"  name="pruzatelj"></span>
                <span class="type-of-user">Pružatelj usluge</span>
            </label>
            </div>
            </div>
            <div class="user-details">
            
            </div>
            <script>
                $('input[type=radio]').click(function(e) {
                    $( ".registration-conainer" ).removeClass( "registration-conainer-height" );
                    var value = $(this).val();
                    var apndHTML = '';
                    if(value == 'korisnik-usluge'){
                    apndHTML = 
                    '<div class="input-box"> \
                        <span class="details">Ime</span> \
                        <input type="text" name="ime" placeholder="Unesite Vaše ime" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Prezime</span> \
                        <input type="text" name="prez" placeholder="Unesite Vaše prezime" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Email</span> \
                        <input type="text" name="email" placeholder="Unesite Vaš email" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Broj telefona</span> \
                        <input type="text" name="tel" placeholder="Unesite Vaš telefona" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Korisničko ime</span> \
                        <input type="text" name="uid" placeholder="Unesite Vaše korisničko ime" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Lozinka</span> \
                        <input type="password" name="pwd" placeholder="Unesite Vašu lozinku" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Potvrda lozinke</span> \
                        <input type="password" name="pwdrepeat" placeholder="Potvrdite Vašu lozinku" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Nadimak</span> \
                        <input type="text" name="nadi" placeholder="Unesite Vaš nadimak" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Država</span> \
                        <select id="drzava" name="drzava"> \
                            <option value="" class="first-option" disabled="disabled" selected>Odaberite državu</option> \
                            <option value= "1" >Hrvatska</option> \
                        </select> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Grad</span> \
                        <select id="grad" class="grad" name="grad"> \
                            <option value="" class="first-option" disabled="disabled" selected>Odaberite grad</option> \
                            <option value="1" name="grad">Split</option> \
                            <option value="73" name="grad">Zadar</option> \
                            <option value="21" name="grad">Kaštela</option> \
                            <option value="39" name="grad">Osijek</option> \
                            <option value="46" name="grad">Pula</option> \
                        </select> \
                    </div>';
                    $('.user-details').html(apndHTML);
                    }
                    else if(value == 'pruzatelj-usluge'){
                    apndHTML = 
                    '<div class="input-box"> \
                        <span class="details">Ime</span> \
                        <input type="text"  class="ime" name="ime" placeholder="Unesite Vaše ime" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Prezime</span> \
                        <input type="text" class="prez" name="prez" placeholder="Unesite Vaše prezime" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Email</span> \
                        <input type="text" class="email" name="email" placeholder="Unesite Vaš email" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Broj telefona</span> \
                        <input type="text" class="tel" name="tel" placeholder="Unesite Vaš telefona" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Korisničko ime</span> \
                        <input type="text" class="uid" name="uid" placeholder="Unesite Vaše korisničko ime" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Lozinka</span> \
                        <input type="password" class="pwd" name="pwd" placeholder="Unesite Vašu lozinku" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Potvrda lozinke</span> \
                        <input type="password" class="pwdrepeat" name="pwdrepeat" placeholder="Potvrdite Vašu lozinku" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Ime poslovnog subjekta</span> \
                        <input type="text" class="posl" name="posl" placeholder="Unesite ime poslovnog subjekta" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Država</span> \
                        <select id="drzava" name="drzava"> \
                            <option value="" class="first-option" disabled="disabled" selected>Odaberite državu</option> \
                            <option value="1" >Hrvatska</option> \
                        </select> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Grad</span> \
                        <select id="grad" class="grad" name="grad"> \
                            <option value="" class="first-option" disabled="disabled" selected>Odaberite grad</option> \
                            <option value="1" name="grad">Split</option> \
                            <option value="73" name="grad">Zadar</option> \
                            <option value="21" name="grad">Kaštela</option> \
                            <option value="39" name="grad">Osijek</option> \
                            <option value="46" name="grad">Pula</option> \
                        </select> \
                    </div>';
                    }
                    $('.user-details').html(apndHTML);
                });
            </script>
            <small class="register-error-small"></small>
            <div class="button">
                <input class="input-btn" type="submit" name="submit" value="Registriraj se">
            </div>
            <small class="register-error-small"></small>
        </form>
        </div>
    </div>
</div>

