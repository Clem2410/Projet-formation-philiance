<?php
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
require_once '../fonction/function_admin.php';
ajout();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/bootstrap.css">
    <title>Admin Ajout</title>
</head>

<body>
    <div class="m-4">
        <div class="">
            <a href="../pages/admin.php" class="btn btn-lg btn-secondary">Retour</a>

        </div>
        <div class="container">
            <p class="ms-5">Pour les différents élements entre "" il faut le remplacer par ce qui expliqué dedans</p>
            <form action="../pages/admin_ajout.php" method="POST" class="row mx-auto" enctype="multipart/form-data">

                <label>Nom :</label><br>
                <input type="text" name="nom"><br>

                <label class="mt-1">Description :</label><br>
                <textarea type="text" name="description"></textarea><br>

                <label class="mt-1">Genres :</label><br>
                <input type=" text" name="genre" placeholder="Veuillez a mettre des , après chaque mot exemple : Action, Aventure, Simulation"><br>

                <label class="mt-1">Developpeur :</label><br>
                <input type="text" name="developpeur"><br>

                <label class="mt-1">Plateformes :</label><br>
                <input type="text" name="plateformes" placeholder="Veuillez a mettre des , après chaque mot exemple : PS4, PS5, Xbox Series, One, Switch, PC"><br>

                <label class="mt-1">Types :</label><br>
                <input type="text" name="type" placeholder="Veuillez a mettre des , après chaque mot exemple : AAA, Coop "><br>

                <label class="mt-1">Date de sortie :</label><br>
                <input type="date" name="date_sortie"><br>

                <div class="form-group  mt-1">
                    <label for="photo">Img jaquette : </label>
                    <input type="file" class="form-control" id="photo" name="lien_img_jaquette">
                </div>
                <label class="mt-1">Lien video :</label><br>
                <input type="text" name="lien_video" value='https://www.youtube.com/embed/'><br>

                <div class="form-group  mt-1">
                    <label for="photo">Image 1 : </label>
                    <input type="file" class="form-control" id="photo" name="lien_img_jeu_1">
                </div>

                <div class="form-group  mt-1">
                    <label for="photo">Image 2 : </label>
                    <input type="file" class="form-control" id="photo" name="lien_img_jeu_2">
                </div>

                <div class="form-group  mt-1">
                    <label for="photo">Image 3 : </label>
                    <input type="file" class="form-control" id="photo" name="lien_img_jeu_3">
                </div>
                <label class="mt-1">Note :</label><br>
                <input type="text" name="note" value=""><br>

                <label class="mt-1">Lien achat :</label><br>
                <input type="text" name="lien_achat" placeholder="Lien https récupérer du site externe"><br>
                <div>
                    <input type="submit" value="Enregistrement" name="submit" onclick="return confirm('Veuillez valider');" class="mt-3">
                </div>
            </form>
        </div>
    </div>
</body>

</html>