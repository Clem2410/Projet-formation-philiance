<?php
require_once "../fonction/navbar.php";
require_once "../fonction/footer.php";
require_once "../fonction/function_admin.php";
session_start();
require_once '../config.php'; // ajout connexion bdd 
// si la session existe pas soit si l'on est pas connecté on redirige
if (!isset($_SESSION['user'])) {
    header('Location:../pages/compte_utilisateur.php');
    die();
}

// On récupere les données de l'utilisateur
$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
$req->execute(array($_SESSION['user']));
$data = $req->fetch();

if ($_SESSION['user'] !== 'd4d02d81b67189fd7b3e593c1a1e79fb961234988f2f9ecaffd2ce675b482d37bedd566361c88b637b4cb9b648e5df9d375802a830f0d73a0fb39e026ce752ae') {
    header('Location:../pages/compte_utilisateur.php');
    die();
}


?>
<!doctype html>
<html lang="en">

<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,100,0,-25" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="m-4">
        <a href="../pages/compte_utilisateur.php" class="btn btn-lg btn-secondary me-5">Retour</a>
        <a href="../pages/admin_ajout.php" class="btn btn-lg btn-info me-5">Ajouter un jeu</a>
        <form class="d-flex mt-3 w-25" action="../pages/admin.php" method="POST">
            <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search" name="admin_search">
            <button class="btn btn-outline-info" type="submit">Search</button>
        </form>
    </div>
    <?php
    if (!empty($_POST['admin_search'])) {
        echo admin_affichage_trier_nom($_POST);
    } else {
        echo admin_affichage();
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>