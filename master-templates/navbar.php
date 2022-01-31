<noscript>Onemogućen Vam je JavaScript. Neke stavke neće funkcionirati kako treba.</noscript>
<header class="navbar-container">
  <a class="logo" href='?page=home'><img src="./assets/img/logo.png" alt="Logo"></a>
  <a href="javascript:void(0);" style="font-size:20px;" class="burger" onclick="responsiveToggle()">&#9776;</a>

  <nav id="responsive" class="navbar">
    <ul>
      <li><a href="?page=home">Početna</a></li>
      <li><a href="?page=pretraga">Pretraga</a></li>
      <li><a href="?page=oNama">O nama</a></li>
      <li><a href="?page=kontakt">Kontakt</a></li>
      <?php
        if(isset($_SESSION["userid"]))
        {
      ?>
      <li><a href="?page=rezervacije">Rezervacije</a></li>
      <?php
        if(isset($_SESSION["pravaUser"])){
            if($_SESSION["pravaUser"] == 2){
                echo '<li><a>Usluge +</a>
                        <ul>
                          <li><a href="?page=kreirajUsluge">Kreiraj usluge</a></li>
                          <li><a href="?page=mojeUsluge">Moje usluge</a></li>
                        </ul>  
                      </li>';
            }
        }
      ?>  
      <li><a><?php echo $_SESSION["useruid"]." +"; ?></a>
        <ul>
          <li><a href="?page=mojProfil">Moj profil</a></li>
          <?php
            if(isset($_SESSION["pravaUser"])){
              if($_SESSION["pravaUser"] == 2){
                echo '<li><a href="?page=obavijesti">Obavijesti</a></li>';
              }
            }
          ?>
          <!-- <li><a href="?page=obavijesti">Obavijesti</a></li> -->
          <li><a href="./system/login/includes/logout.inc.php">Odjava</a></li>
        </ul>  
      </li>
      <?php
          }
          else
          {
      ?>
      <li><a href="?page=login">Prijava</a></li>
      <?php     
          }
      ?>
    </ul>
  </nav>
</header>