<?php
    // Ucitavanje headera i heada
    require_once('./master-templates/header.php');
    require_once('./master-templates/head.php');
?>

<?php
    //Ucitavanje Navbara
    require_once('./master-templates/navbar.php');
?>
<?php
    //Dynamic Website code
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $display = 'content/'.$page.'.php';
        include($display);
    }else{
        include('content/home.php');
    }
?>
<?php
    require_once('./master-templates/footer.php');
?>
<?php
    require_once('./master-templates/loader.php');
?>
