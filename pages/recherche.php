<?php
require_once "../config.php";
require_once "../fonction/navbar.php";
require_once "../fonction/affichages_jeux.php";
require_once "../fonction/footer.php";
require_once "../fonction/tri.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,100,0,-25" />
    <link rel="stylesheet" href="../assets/style/style_card.css">
    <!-- <link rel="stylesheet" href="../assets/style/footer.css"> -->
    <title>Recherche</title>
</head>

<body style="background-image: linear-gradient(to right, #212529, #517873); font-size: 1.5em;">
    <?php

    // appel navbar
    echo navbar();
    if (!empty($_POST['search'])) {
        echo affichage_trier_nom($_POST);
    } else {
        header("location: ../pages/categorie.php");
    }
    echo footer();
    ?>
    <script src="../assets/js/bootstrap.js"></script>
</body>

</html>