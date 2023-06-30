<?php
require_once "../fonction/navbar.php";
require_once "../fonction/footer.php";
require_once "../fonction/favori.php";
session_start();
require_once '../config.php'; // ajout connexion bdd 
// si la session existe pas soit si l'on est pas connecté on redirige

$varConn;

if (isset($_SESSION['user'])) {
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();
    $varConn = true;
} else {
    $varConn = false;
}

getIfInFavori($varConn);

if (isset($_GET['jeu'])) {
    $query = $bdd->query("SELECT * FROM liste_jeux where id_jeu=" . $_GET['jeu'])->fetchAll(PDO::FETCH_ASSOC);
} else if (isset($_GET['jeu_nouvautes'])) {
    $query = $bdd->query("SELECT * FROM sorties_recentes where id_jeu=" . $_GET['jeu_nouvautes'])->fetchAll(PDO::FETCH_ASSOC);
} else if (isset($_GET['jeu_populaires'])) {
    $query = $bdd->query("SELECT * FROM jeux_populaires where id_jeu=" . $_GET['jeu_populaires'])->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="FR-fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style_jeu.css">
    <link rel="stylesheet" href="../assets/style/bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,100,0,-25" />
    <title>Page jeu type</title>
</head>

<body style="background-image: linear-gradient(to right, #212529, #517873); font-size: 1.5em;">
    <?php
    // appel navbar
    echo navbar();
    ?>
    <!-- affichage du jeu/détails -->
    <div class="rounded couleur-text d-flex col-10 mx-auto my-5 p-5 ">
        <div class="img-video-desc col-10">
            <h1><?= $query[0]['nom'] ?></h1>
            <div class="d-flex">
                <img width="25%" height="25%" src='<?= $query[0]['img_jaquette'] ?>' alt=' image jeu' class="img-responsive m-4">
                <div class="mx-5  mt-4">
                    <iframe width="100%" height="75%" src="<?= $query[0]['lien_video'] ?>" title="<?= $query[0]['nom'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    <div class="mt-2">

                        <a href="<?= $query[0]['lien_img_jeu_1'] ?>"><img width="25%" height="25%" src="<?= $query[0]['lien_img_jeu_1'] ?>" alt="" class="mx-4"></a>
                        <a href="<?= $query[0]['lien_img_jeu_2'] ?>"><img width="25%" height="25%" src="<?= $query[0]['lien_img_jeu_2'] ?>" alt="" class="mx-4"></a>
                        <a href="<?= $query[0]['lien_img_jeu_3'] ?>"><img width="25%" height="25%" src="<?= $query[0]['lien_img_jeu_3'] ?>" alt="" class="mx-4"></a>
                    </div>
                </div>
            </div>
            <p class="mt-5"><?= $query[0]['description'] ?></p>
        </div>

        <div class="col-2  d-flex flex-column <?php if ((isset($_GET['jeu']) & $varConn === false) || isset($_GET['jeu_nouvautes']) || isset($_GET['jeu_populaires'])) {
                                                    echo "mt-5";
                                                } ?>">
            <div>
                <?php
                if (isset($_GET['jeu']) & isset($_SESSION['user'])) {
                    echo getIfInFavori($varConn);
                }

                ?>
            </div>
            <div>
                <h2 class="mt-4 fs-4">Genres :</h2>
                <p><?= $query[0]['genre'] ?></p>
            </div>
            <div>
                <h2 class="fs-4 mt-2">Développeur :</h2>
                <p><?= $query[0]['developpeur'] ?></p>
            </div>
            <div>
                <h2 class="fs-4 mt-2">Plateformes :</h2>
                <p><?= $query[0]['plateformes'] ?></p>
            </div>
            <div>
                <h3 class="fs-4 mt-2">Date de sortie :</h2>
                    <p><?= $query[0]['date_sortie'] ?></p>
            </div>
            <div>
                <h2 class="text-center fs-4">Note : </h2>
                <div class="text-center border border-success border-3 rounded-3 mx-5 fs-2 fw-bold mt-2 m-4">
                    <?= $query[0]['note'] ?>
                </div>
                <div>
                    <h3 class="text-center fs-4 mt-2 m-3">Achetez le jeu au meilleur prix !</h3>
                    <a class="text-center rounded-3 mx-5" href="<?php echo $query[0]['lien_achat'] ?>" target="_blank"><img src="../assets/image/icons8-sale-price-tag-60.png"></a>
                </div>

            </div>
        </div>
    </div>
    <?php
    echo footer();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>