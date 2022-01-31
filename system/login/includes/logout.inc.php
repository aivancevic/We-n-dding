<?php


session_start();
session_unset();
session_destroy();


//nazad na glavnu
header("location: ../../../index.php?page=home");
