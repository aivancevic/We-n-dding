<?php 
    include "./system/PUO2/puo2.inc.php";
?>

  <section>
    <ul>
      <li class="list active" data-filter="sve">Sve</li>
      <li class="list" data-filter="glazba">Glazba</li>
      <li class="list" data-filter="hrana">Hrana</li>
      <li class="list" data-filter="prostor">Prostor</li>
      <li class="list" data-filter="medija">Medija</li>
      <li class="list" data-filter="ostalo">Ostalo</li>
    </ul>
  </section>
  
  <div  class="main">
    <ul class="cards">
      <?php 
        echo $GLOBALS["prostorsve2"]; 
        echo $GLOBALS["glazbasve2"];
        echo $GLOBALS["hranasve2"];
        echo $GLOBALS["dekoracijasve2"];
        echo $GLOBALS["mediasve2"];
        echo $GLOBALS["ostalosve2"]; 
      ?>
    </ul>
  </div>

  <?php echo $GLOBALS["datepickerFunctions"]; ?>
</section> 