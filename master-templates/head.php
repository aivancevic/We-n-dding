<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wendding | Order your wedding</title>

    <!--Tab icon-->
    <link class='tabIcon' rel="icon" href="./assets/icons/tab-iconW.png">
    <!--Fav icon-->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"
      integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V"
      crossorigin="anonymous"
    />

    <!-- CSS Design Link -->
    <link rel="stylesheet" href="./assets/css/styles.css">
    <?php
        if(isset($_GET['page'])){
            $pageCSS = $_GET['page'];
            $displayCSS = '<link rel="stylesheet" href="./assets/css/'.$pageCSS.'.css">';
            echo $displayCSS;
        }else{
            echo '<link rel="stylesheet" href="./assets/css/home.css">';
        }
    ?>
    <!-- date picker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    

    <!--Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">

    <!-- Učitavanje vanjskog JavaScript dokumenta -->
    <script defer src="./assets/js/navbar.js"></script>
    <script defer src="./assets/js/pretraga.js"></script>
    <script defer src="./assets/js/cookies.js"></script>
    <script defer src="./assets/js/loader.js"></script>
 
<body>