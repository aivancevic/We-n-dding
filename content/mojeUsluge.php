<?php 
    include "./system/prikazUsluga2/prikazusluga2.inc.php";
?>
<h1>Moje usluge</h1>
<div class="main">
  <ul class="cards">
    <?php 
      echo $GLOBALS["prostor"]; 
      echo $GLOBALS["glazba"];
      echo $GLOBALS["hrana"];
      echo $GLOBALS["dekoracija"];
      echo $GLOBALS["media"];
      echo $GLOBALS["ostalo"]; 
    ?>
  </ul>
</div>