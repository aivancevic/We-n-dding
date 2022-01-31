<?php
    include "./system/obavijesti/obavijesti.inc.php";
?>

<section class="obavijesti-section">
    <h1 class="obavijesti-h1">Moje obavijesti:</h1>
    <section class="obavijesti-section-container">

    <?php 
        echo $GLOBALS["nemaObavijesti"];
        echo $GLOBALS["sveObavijesti"];
    ?>

    </section>
</section>