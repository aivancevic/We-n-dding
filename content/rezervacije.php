<?php 
    include "./system/PrikazRezervacija/prikazrezervacija.inc.php";

?>

<section class="rezervacije-section">
    <h1 class="rezervacije-h1">Moje rezervacije:</h1>
    <section class="rezervacije-section-container">

    <?php 
        echo $GLOBALS["nemaUsluga"];
        echo $GLOBALS["rezprostor"]; 
        echo $GLOBALS["rezglazba"];
        echo $GLOBALS["rezhrana"];
        echo $GLOBALS["rezdekoracija"];
        echo $GLOBALS["rezmedia"];
        echo $GLOBALS["rezostalo"]; 
    ?>

    </section>
</section>

