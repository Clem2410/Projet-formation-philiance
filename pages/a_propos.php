<?php
require_once "../config.php";
require_once "../fonction/navbar.php";
require_once "../fonction/footer.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,100,0,-25" />
    <title>A propos de nous</title>
</head>

<body style="background-image: linear-gradient(to right, #212529, #517873); font-size: 1.5em;">
    <?php
    // appel navbar
    echo navbar();
    ?>
    <h1 style="color:white" class="text-center mt-5">A propos de nous</h1>
    <div class="rounded couleur-text d-flex col-10 mx-auto my-5 p-5">
        <p style="color:white">
            Ce site web a été créé par une équipe de 3 jeunes développeurs dans le cadre d'un projet universitaire pour notre formation en développement web. En tant que passionnés de jeux vidéo, nous avons voulu créer un espace en ligne pour rassembler toutes les informations dont les joueurs ont besoin sur leurs jeux préférés. <br><br>

            Nous avons décidé de créer ce site pour fournir des informations détaillées sur les jeux, des bandes-annonces, des captures d'écran, et plus encore. Nous voulons fournir une plateforme pour les joueurs de tous niveaux, des débutants aux professionnels, pour découvrir les dernières tendances et actualités du monde des jeux vidéo. <br><br>

            Nous espérons que vous apprécierez votre visite sur notre site ! Nous voulons vous donner la possibilité de découvrir de nouveaux jeux qui correspondent à vos goûts en utilisant des filtres pour sélectionner les genres, les plateformes et les types de jeux. Nous avons également mis en place un système de notation pour que les utilisateurs puissent donner leur avis sur les jeux.<br><br>

            Nous mettrons tout en œuvre pour vous offrir une expérience de qualité. N'hésitez pas à nous faire part de vos commentaires et suggestions afin que nous puissions continuer à améliorer notre site. Nous sommes également toujours à la recherche de nouveaux contributeurs pour écrire des critiques et des actualités sur les jeux vidéo. Si vous êtes intéressé, n'hésitez pas à nous contacter. <br><br>

        </p>
        <textarea name="" id="" cols="30" rows="10"></textarea>
        <style>
            .couleur-text {
                color: white;
                background-color: #212529;
                box-shadow: 0px 10px 10px black;
            }

            .note {
                text-align: center;
            }
        </style>
    </div>

    <?php
    echo footer();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>