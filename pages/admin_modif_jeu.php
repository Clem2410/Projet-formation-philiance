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

$query = null;
if (isset($_GET['id_jeu'])) {
    $query = $bdd->query("SELECT * FROM liste_jeux where id_jeu=" . $_GET['id_jeu'])->fetchAll(PDO::FETCH_ASSOC);
} else {
    require_once '../fonction/function_admin.php';
    modif();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/bootstrap.css">
    <title>Admin modif</title>
</head>

<body>
    <div class="m-4">
        <div class="d-flex">
            <a href="../pages/admin.php" class="btn btn-lg btn-secondary">Retour</a>
        </div>
        <div class="container">

            <form action="../pages/admin_modif_jeu.php" method="POST" class="row mx-auto" enctype="multipart/form-data">

                <input type="hidden" name="id_hidden" value="<?php echo $_GET['id_jeu'] ?>">


                <label>Nom :</label><br>
                <input type="text" name="nom" value="<?= $query[0]['nom'] ?>"><br>

                <label class="mt-1">Description :</label><br>
                <textarea type="text" name="description" style="height: 100px;"><?= $query[0]['description'] ?></textarea><br>

                <label class="mt-1">Genres :</label><br>
                <input type=" text" name="genre" value="<?= $query[0]['genre'] ?>"><br>

                <label class="mt-1">Developpeur :</label><br>
                <input type="text" name="developpeur" value="<?= $query[0]['developpeur'] ?>"><br>

                <label class="mt-1">Plateformes :</label><br>
                <input type="text" name="plateformes" value="<?= $query[0]['plateformes'] ?>"><br>

                <label class="mt-1">Types :</label><br>
                <input type="text" name="type" value="<?= $query[0]['type'] ?>"><br>

                <label class="mt-1">Date de sortie :</label><br>
                <input type="date" name="date_sortie" value="<?= $query[0]['date_sortie'] ?>"><br>

                <div class="form-group  mt-1">
                    <label for="photo">Img jaquette : </label>
                    <input type="file" class="form-control" id="photo" name="lien_img_jaquette">
                </div>

                <label class="mt-1">Lien video :</label><br>
                <input type="text" name="lien_video" value='<?= $query[0]['lien_video'] ?>'><br>

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
                <input type="text" name="note" value="<?= $query[0]['note'] ?>"><br>

                <label class="mt-1">Lien achat :</label><br>
                <input type="text" name="lien_achat" value="<?= $query[0]['lien_achat'] ?>"><br>
                <div>
                    <input type="submit" value="Enregistrement" name="submit" onclick="return confirm('Veuillez valider');" class="mt-3"><br>
                </div>
            </form>
        </div>
    </div>
</body>

</html>