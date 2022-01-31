<?php 
    include "./system/login/drzave/drzave.inc.php";
?>
<div class="registration-conainer registration-conainer-height">
    <div class="container">
        <div class="title">Kreiranje usluge</div>
        <div class="content">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <form action="./system/kreiranjeUsluge/kreiranjeusluge.inc.php" method="post">
            <div class="tip-usluge">
                <input type="radio" name="tip_usluge" id="dot-1" value="prostor">
                <input type="radio" name="tip_usluge" id="dot-2" value="glazba">
                <input type="radio" name="tip_usluge" id="dot-3" value="hrana">
                <input type="radio" name="tip_usluge" id="dot-4" value="dekoracija">
                <input type="radio" name="tip_usluge" id="dot-5" value="media">
                <input type="radio" name="tip_usluge" id="dot-6" value="ostalo">
                <span class="type-of-user-title">Odaberite vrstu usluge i njene detalje</span>
                <div class="category">
                    <label for="dot-1">
                        <span class="dot one" name="prostor"></span>
                        <span class="type-of-user">Prostor</span>
                    </label>
                    <label for="dot-2">
                        <span class="dot two"  name="glazba"></span>
                        <span class="type-of-user">Glazba</span>
                    </label>
                    <label for="dot-3">
                        <span class="dot three"  name="hrana"></span>
                        <span class="type-of-user">Hrana</span>
                    </label>
                    <label for="dot-4">
                        <span class="dot four"  name="dekoracija"></span>
                        <span class="type-of-user">Dekoracija</span>
                    </label>
                    <label for="dot-5">
                        <span class="dot five"  name="media"></span>
                        <span class="type-of-user">Media</span>
                    </label>
                    <label for="dot-6">
                        <span class="dot six"  name="ostalo"></span>
                        <span class="type-of-user">Ostalo</span>
                    </label>
                </div>
            </div>
            <div class="user-details">
            
            </div>
            <script>
                $('input[type=radio]').click(function(e) {
                    var value = $(this).val();
                    var apndHTML = '';
                    if(value == 'prostor'){
                    apndHTML = 
                    '<div class="input-box"> \
                        <span class="details">Ime</span> \
                        <input type="text" name="ime_prostora" placeholder="Ime prostora" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Kapacitet prostora</span> \
                        <select id="kapacitet" name="kapacitet"> \
                            <option value="" class="first-option" disabled="disabled" selected>Odaberite kapacitet</option> \
                            <option value="<50" name="grad"><50</option> \
                            <option value="50-100" name="grad">50-100</option> \
                            <option value="100-150" name="grad">100-150</option> \
                            <option value="150-200" name="grad">150-200</option> \
                            <option value=">250+" name="grad">250+</option> \
                        </select> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Cijena</span> \
                        <input type="text" name="cijena" placeholder="Cijena u HRK" required> \
                    </div> ';
                    $('.user-details').html(apndHTML);
                    }
                    else if(value == 'hrana'){
                    apndHTML = 
                    '<div class="input-box"> \
                        <span class="details">Način posluživanja</span> \
                        <select id="grad" name="nacin_posluzivanja"> \
                            <option value="" class="first-option" disabled="disabled" selected>Odaberite način posluživanja</option> \
                            <option value="Večera u sali" name="grad">Večera u sali</option> \
                            <option value="Catering" name="grad">Catering</option> \
                        </select> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Ime menija</span> \
                        <input type="text" name="ime_menija" placeholder="Unesite ime Vašeg menija" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Cijena</span> \
                        <input type="text" name="cijena" placeholder="Cijena u HRK" required> \
                    </div> ';
                    }
                    else if(value == 'dekoracija'){
                    apndHTML = 
                    '<div class="input-box"> \
                        <span class="details">Vrsta dekoracije</span> \
                        <select id="vrsta_dekoracije" name="vrsta_dekoracije"> \
                            <option value="" class="first-option" disabled="disabled" selected>Odaberite vrstu dekoracije</option> \
                            <option value="Reveri" name="grad">Reveri</option> \
                            <option value="Cvijeće" name="grad">Cvijeće</option> \
                            <option value="Ukrasi" name="grad">Ukrasi</option> \
                        </select> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Ime vaše dekorativne kombinacije</span> \
                        <input type="text" name="ime_dekoracije" placeholder="Unesite ime Vaše dekorativne kombinacije" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Cijena</span> \
                        <input type="text" name="cijena" placeholder="Cijena u HRK" required> \
                    </div> ';
                    }
                    else if(value == 'media'){
                    apndHTML = 
                    '<div class="input-box"> \
                        <span class="details">Vrsta medie</span> \
                        <select id="vrsta_medie" name="vrsta_medie"> \
                            <option value="" class="first-option" disabled="disabled" selected>Odaberite mediu</option> \
                            <option value="Fotograf" name="grad">Fotograf</option> \
                            <option value="Snimatelj" name="grad">Snimatelj</option> \
                        </select> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Cijena</span> \
                        <input type="text" name="cijena" placeholder="Cijena u HRK" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Ime medijske usluge</span> \
                        <input type="text" name="ime_medie" placeholder="Unesite ima Vaše medijske usluge" required> \
                    </div> ';
                    }
                    else if(value == 'ostalo'){
                    apndHTML = 
                    '<div class="input-box"> \
                        <span class="details">Vrsta ostalih usluga</span> \
                        <select id="vrsta_ostalog" name="vrsta_ostalog"> \
                            <option value="" class="first-option" disabled="disabled" selected>Odaberite neku od ostalih usluga</option> \
                            <option value="Vatromet" name="grad">Vatromet</option> \
                            <option value="Rent a car" name="grad">Rent a car</option> \
                        </select> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Ime usluge</span> \
                        <input type="text" name="ime_ostale_usluge" placeholder="Unesite ime Vaše usluge" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Cijena</span> \
                        <input type="text" name="cijena" placeholder="Cijena u HRK" required> \
                    </div> ';
                    }
                    else if(value == 'glazba'){
                    apndHTML = 
                    '<div class="input-box"> \
                        <span class="details">Tip izvođača</span> \
                        <select id="tip_izvodaca" name="tip_izvodaca"> \
                            <option value="" class="first-option" disabled="disabled" selected>Odaberite tip izvođača</option> \
                            <option value="Band" name="grad">Band</option> \
                            <option value="DJ" name="grad">DJ</option> \
                            <option value="Klapa" name="grad">Klapa</option> \
                        </select> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Ime Glazbenog Sastava</span> \
                        <input type="text" name="ime_glazbenog_sastava" placeholder="Unesite ime glazbenog sastava" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Žanr glazbe</span> \
                        <input type="text" name="vrsta_glazbe" placeholder="Unesite žanr glazbe" required> \
                    </div> \
                    <div class="input-box"> \
                        <span class="details">Cijena</span> \
                        <input type="text" name="cijena" placeholder="Cijena u HRK" required> \
                    </div> ';
                    }
                    $('.user-details').html(apndHTML);
                });
            </script>
            <div class="button">
                <input type="submit" name="submit" value="Kreiraj uslugu">
            </div>
        </form>
        </div>
    </div>
</div>