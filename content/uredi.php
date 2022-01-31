<?php 
    include "./system/urediProfil/urediProfil.inc.php";

?>

<?php
    echo $GLOBALS["profil"];
?>

<!-- <div class="registration-conainer registration-conainer-height">
    <div class="container">
        <div class="title">Uredi profil</div>
        <div class="content">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <form class="edit-form" action="./system/urediProfil/urediProfil.inc.php" method="post">
            <div class="user-details">
                <div class="input-box"> 
                    <span class="details">Ime</span> 
                    <input type="text" name="ime" placeholder="Unesite Vaše ime" required> 
                </div> 
                <div class="input-box"> 
                    <span class="details">Prezime</span> 
                    <input type="text" name="prez" placeholder="Unesite Vaše prezime" required> 
                </div>
                <div class="input-box"> 
                    <span class="details">Broj telefona</span> 
                    <input type="text" name="tel" placeholder="Unesite Vaš telefona" required> 
                </div>
                <div class="input-box"> 
                    <span class="details">Nadimak</span> 
                    <input type="text" name="nadi" placeholder="Unesite Vaš nadimak" required> 
                </div> 
                <div class="input-box"> 
                    <span class="details">Država</span> 
                    <select id="drzava" name="drzava"> 
                        <option value="" class="first-option" disabled="disabled" selected>Odaberite državu</option> 
                        <option value= "1" >Hrvatska</option> 
                    </select> 
                </div> 
                <div class="input-box"> 
                    <span class="details">Grad</span> 
                    <select id="grad" name="grad"> 
                        <option value="" class="first-option" disabled="disabled" selected>Odaberite grad</option> 
                        <option value="1" name="grad">Split</option> 
                        <option value="73" name="grad">Zadar</option> 
                        <option value="21" name="grad">Kaštela</option> 
                        <option value="39" name="grad">Osijek</option>
                        <option value="46" name="grad">Pula</option> 
                    </select> 
                </div>
            </div>
        <div class="button">
            <input class="input-btn" type="submit" name="submit" value="Snimi promjene">
        </div>
    </form>
</div> -->