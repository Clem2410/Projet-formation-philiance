<?php
require_once "../fonction/navbar.php";
require_once "../fonction/footer.php";
session_start();
require_once '../config.php'; // ajout connexion bdd 
// si l'on est pas connecté on redirige
if (!isset($_SESSION['user'])) {
    header('Location:../pages/page_connexion.php');
    die();
}

// On récupere les données de l'utilisateur
$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
$req->execute(array($_SESSION['user']));
$data = $req->fetch();

// var_dump($_SESSION['user']);

if (isset($_POST['submit'])) {
    try {
        $tes = $bdd->prepare(
            "UPDATE utilisateurs 
    SET 
    pseudo = :pseudo,
    email = :email
    WHERE id = :id"
        );
        $tes->execute([
            'pseudo' => $_POST['pseudo'],
            'email' => $_POST['email'],
            'id' => $data['id'],
        ]);
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    }
    header("location: http://localhost/projet/pages/compte_utilisateur.php ");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,100,0,-25" />
    <title>Document</title>
</head>

<body style="background-image: linear-gradient(to right, #212529, #517873); font-size: 1.5em;">
    <?php

    // appel navbar
    echo navbar();

    ?>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h3>Voici vos informations :</h3>
                                <form class="d-flex flex-column align-items-center mx-auto" action="../pages/compte_update.php" method="post">
                                    <br>
                                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                    <label class="form-label" id="a" for="">
                                        Votre pseudo
                                        <input class="form-control" name="pseudo" type="text" value="<?= $data['pseudo'] ?>">
                                    </label>
                                    <label class="form-label" for="">
                                        Votre adresse Mail
                                        <input class="form-control" name="email" type="mail" value="<?= $data['email'] ?>">
                                    </label>
                                    <button name="submit" class="btn btn-outline-light btn-lg px-6 m-3">Valider</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php
    echo footer();
    ?>
</body>

</html>