<?php 
    include "./system/profil/mojProfil.inc.php";
?>

<div id="profile-container">
    <div class="card">
        <div class="avatar2"></div>
        <div class="cover"></div>
        <div class="user-info-main">
            <h1 style="color: #FFF;"><?php echo $_SESSION["imeUser"].' '.$_SESSION["prezimeUser"]?><h1>
            <h2 style="color: #616b81;"><?php echo $_SESSION["imePravaUser"] ?><h2>
        </div>
        <div class="divider2"></div>
        <div class="profile-info">
            <div class="profile-item">
                <span class="icons" style="color:#616b81;"><i class="fas fa-map-marker-alt icon"></i></span>
                <span class="about-user" style="color:#616b81;"><?php echo $_SESSION["imeGradaUser"].', '.$_SESSION["imeDrzaveUser"] ?></span>
            </div>
            <div class="profile-item">
                <span class="icons" style="color:#616b81;"><i class="fas fa-envelope icon"></i></span>
                <span class="about-user" style="color:#616b81;"><?php echo $_SESSION["emailUser"] ?></span>
            </div>
            <div class="profile-item">
                <span class="icons" style="color:#616b81;"><i class="fas fa-mobile-alt"></i></span>
                <span class="about-user" style="color:#616b81;"><?php echo '+385 '.$_SESSION["brojTelefonaUser"] ?></span>
            </div>           
        </div>
        <a href="?page=uredi">
            <div class="btn btn-three btn-uredi">
                <span>UREDI</span>
            </div>
        </a>
        <a href="?page=rezervacije">
            <div class="btn btn-three btn-rezervacije">
                <span>REZERVACIJE</span>
            </div> 
        </a>
    </div>
</div>