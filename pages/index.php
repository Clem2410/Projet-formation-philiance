<?php
require_once "../config.php";
require_once "../fonction/tri.php";
require_once "../fonction/navbar.php";
require_once "../fonction/footer.php";
// récupération des données jeu
$liste = $bdd->query('SELECT * FROM liste_jeux')->fetchAll(PDO::FETCH_ASSOC);
$populaires = $bdd->query('SELECT * FROM jeux_populaires')->fetchAll(PDO::FETCH_ASSOC);
$nouvautes = $bdd->query('SELECT * FROM sorties_recentes')->fetchAll(PDO::FETCH_ASSOC);
// jeu random 
$img1 = rand(0, 125);
$img2 = rand(0, 125);
$img3 = rand(0, 125);
$img4 = rand(0, 125);
$img5 = rand(0, 125);

$id_jeu = rand(0, 125);
if ($_POST) {
    if (isset($_POST['search']) & !empty($_POST['search'])) {
        $parametre = $_POST['search'];
    }
}

?>
<!DOCTYPE html>
<html lang="FR-fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,100,0,-25" />
    <link rel="stylesheet" href="../assets/style/style_accueil.css">
    <link rel="stylesheet" href="../assets/style/style_navbar.css">
    <title>Accueil</title>
</head>

<body style="background-image: linear-gradient(to right, #212529, #517873); font-size: 1.5em;">
    <?php

    // appel navbar
    echo navbar();
    ?>

    <div class="rounded couleur-text d-flex col-10 mx-auto my-2 p-2">
        <a href="../pages/categorie.php" class="btn btn-outline-dark btn-lg mx-auto col-md-2 h-50 my-auto p-5" style="border: none; background: linear-gradient(45deg, #212529, #517873); color: white; padding: 1rem; border-radius: 100px; text-align: center; text-transform: uppercase; font-size: 18px; height: 55px; cursor: pointer;">Recherche avancée</a>

        <div id="carouselExampleIndicators" class="carousel slide col-md-3 p-3" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="../pages/jeu.php?jeu= <?= $liste[$img1]['id_jeu'] ?>">
                        <img src="<?= $liste[$img1]['img_jaquette'] ?>" class="d-block w-100" alt="<?= $liste[$img1]['nom'] ?>" height="450px" width="300px">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="../pages/jeu.php?jeu=<?= $liste[$img2]['id_jeu'] ?>">
                        <img src="<?= $liste[$img2]['img_jaquette'] ?>" class="d-block w-100" alt="<?= $liste[$img2]['nom'] ?>" height="450px" width="300px">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="../pages/jeu.php?jeu= <?= $liste[$img3]['id_jeu'] ?>">
                        <img src="<?= $liste[$img3]['img_jaquette'] ?>" class="d-block w-100" alt="<?= $liste[$img3]['nom'] ?>" height="450px" width="300px">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="../pages/jeu.php?jeu= <?= $liste[$img4]['id_jeu'] ?>">
                        <img src="<?= $liste[$img4]['img_jaquette'] ?>" class="d-block w-100" alt="<?= $liste[$img4]['nom'] ?>" height="450px" width="300px">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="../pages/jeu.php?jeu= <?= $liste[$img5]['id_jeu'] ?>">
                        <img src="<?= $liste[$img5]['img_jaquette'] ?>" class="d-block w-100" alt="<?= $liste[$img5]['nom'] ?>" height="450px" width="300px">
                    </a>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <a href="../pages/jeu.php?jeu= <?php echo $id_jeu ?>" class="btn btn-outline-dark btn-lg col-md-2 h-25 my-auto mx-auto p-5" style="border: none; background: linear-gradient(45deg, #212529, #517873); color: white; padding: 1rem; border-radius: 100px; text-align: center; text-transform: uppercase; font-size: 18px; height: 55px; cursor: pointer;">Jeu aléatoire</a>

        <style>
            .couleur-text {
                color: white;
                background-color: #212529;
                box-shadow: 0px 10px 10px black
            }

            .note {
                text-align: center
            }
        </style>

    </div>
    <h5 class="text-center p-3" style="color: white">Bienvenue sur notre site de jeux vidéo !<br>
        Vous êtes fan de jeux vidéo et vous cherchez un nouveau titre à découvrir ? Vous êtes au bon endroit !<br>

        Notre site vous propose une plateforme de recherche et d'information sur les jeux vidéo, avec des fiches détaillés de jeux, des articles sur l'industrie du jeu vidéo, la possibilité de comparer les prix des jeux sur différentes plateformes d’achat pour vous aider à trouver les meilleures offres et bien plus encore !<br>

        Utilisez notre moteur de recherche avancé pour trouver les jeux qui correspondent à vos goûts, ou parcourez les différentes catégories pour découvrir de nouvelles pépites !<br>

        Pas encore membre ? Inscrivez-vous pour enregistrer vos jeux favoris et accéder à toutes les fonctionnalités de notre site.<br>
    </h5>
    <h1 class="nav-link active"><a href="../pages/Jeux_populaires.php" style="color: #FFFFFF">Populaires en ce moment</a></h1>
    <div class="row p-3 mx-2">
        <div class="card mx-3 text-light" style="width: 18rem; background-color: #212529">
            <a href="../pages/jeu.php?jeu_populaires=<?= $populaires[3]['id_jeu'] ?>"><img src="<?= $populaires[3]['img_jaquette'] ?>" class="card-img-top rounded" alt="..."></a>
            <div class="card-body">
                <h4 class="card-title"><?= $populaires[3]['nom'] ?></h4>
                <p class="lead"><?= $populaires[3]['description'] ?></p>
            </div>
            <div class="card-body">
            </div>
        </div>
        <div class="card mx-3 text-light" style="width: 18rem; background-color: #212529">
            <a href="../pages/jeu.php?jeu_populaires=<?= $populaires[6]['id_jeu'] ?>"><img src="<?= $populaires[6]['img_jaquette'] ?>" class="card-img-top rounded" alt="..."></a>
            <div class="card-body">
                <h4 class="card-title"><?= $populaires[6]['nom'] ?></h4>
                <p class="lead"><?= $populaires[6]['description'] ?></p>
            </div>
            <div class="card-body">
            </div>
        </div>
        <div class="card mx-3 text-light" style="width: 18rem; background-color: #212529">
            <a href="../pages/jeu.php?jeu_populaires=<?= $populaires[8]['id_jeu'] ?>"><img src="<?= $populaires[8]['img_jaquette'] ?>" class="card-img-top rounded" alt="..."></a>

            <div class="card-body">
                <h4 class="card-title"><?= $populaires[8]['nom'] ?></h4>
                <p class="lead"><?= $populaires[8]['description'] ?></p>
            </div>
            <div class="card-body">
            </div>
        </div>
        <div class="card mx-3 text-light" style="width: 18rem; background-color: #212529">
            <a href="../pages/jeu.php?jeu_populaires=<?= $populaires[12]['id_jeu'] ?>"><img src="<?= $populaires[12]['img_jaquette'] ?>" class="card-img-top rounded" alt="..."></a>
            <div class="card-body">
                <h4 class="card-title"><?= $populaires[12]['nom'] ?></h4>
                <p class="lead"><?= $populaires[12]['description'] ?></p>
            </div>
            <div class="card-body">
            </div>
        </div>
        <div class="card mx-3 text-light" style="width: 18rem; background-color: #212529">
            <div>
                <a href="../pages/jeu.php?jeu_populaires=<?= $populaires[15]['id_jeu'] ?>"><img src="<?= $populaires[15]['img_jaquette'] ?>" class="card-img-top rounded" alt="..."></a>
            </div>
            <div class="card-body">
                <h4 class="card-title"><?= $populaires[15]['nom'] ?></h4>
                <p class="lead"><?= $populaires[15]['description'] ?></p>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
    <h1 class="nav-link active"><a href="../pages/nouvautes.php " style="color: #FFFFFF">Dernières sorties</a></h1>
    <div class="row p-4 mx-3">
        <div class="card mx-3 text-light" style="width: 18rem; background-color: #212529">
            <div>
                <a href="../pages/jeu.php?jeu_nouvautes=<?= $nouvautes[0]['id_jeu'] ?>"><img src="<?= $nouvautes[0]['img_jaquette'] ?>" class="card-img-top rounded" alt="..."></a>
            </div>
            <div class="card-body">
                <h4 class="card-title"><?= $nouvautes[0]['nom'] ?></h4>
                <p class="lead"><?= $nouvautes[0]['description'] ?></p>
            </div>
            <div class="card-body">
            </div>
        </div>
        <div class="card mx-3 text-light" style="width: 18rem; background-color: #212529">
            <div>
                <a href="../pages/jeu.php?jeu_nouvautes=<?= $nouvautes[1]['id_jeu'] ?>"><img src="<?= $nouvautes[1]['img_jaquette'] ?>" class="card-img-top rounded" alt="..."></a>
            </div>
            <div class="card-body">
                <h4 class="card-title"><?= $nouvautes[1]['nom'] ?></h4>
                <p class="lead"><?= $nouvautes[1]['description'] ?></p>
            </div>
        </div>
        <div class="card mx-3 text-light" style="width: 18rem; background-color: #212529">
            <div>
                <a href="../pages/jeu.php?jeu_nouvautes=<?= $nouvautes[22]['id_jeu'] ?>"><img src="<?= $nouvautes[22]['img_jaquette'] ?>" class="card-img-top rounded" alt="..."></a>
            </div>
            <div class="card-body">
                <h4 class="card-title"><?= $nouvautes[22]['nom'] ?></h4>
                <p class="lead"><?= $nouvautes[22]['description'] ?></p>
            </div>
        </div>
        <div class="card mx-3 text-light" style="width: 18rem; background-color: #212529">
            <div>
                <a href="../pages/jeu.php?jeu_nouvautes=<?= $nouvautes[24]['id_jeu'] ?>"><img src="<?= $nouvautes[24]['img_jaquette'] ?>" class="card-img-top rounded" alt="..."></a>
            </div>
            <div class="card-body">
                <h4 class="card-title"><?= $nouvautes[24]['nom'] ?></h4>
                <p class="lead"><?= $nouvautes[24]['description'] ?></p>
            </div>
        </div>
        <div class="card mx-3 text-light" style="width: 18rem; background-color: #212529">
            <div>
                <a href="../pages/jeu.php?jeu_nouvautes=<?= $nouvautes[4]['id_jeu'] ?>"><img src="<?= $nouvautes[4]['img_jaquette'] ?>" class="card-img-top rounded" alt="..."></a>
            </div>
            <div class="card-body">
                <h4 class="card-title"><?= $nouvautes[4]['nom'] ?></h4>
                <p class="lead"><?= $nouvautes[4]['description'] ?></p>
            </div>
        </div>
    </div>

    <?php
    echo footer();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>


</html>