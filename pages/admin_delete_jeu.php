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
require_once '../config.php';
if (isset($_GET["id_jeu"])) {

    $id = $_GET["id_jeu"];
    $result = $bdd->exec("DELETE FROM liste_jeux WHERE id_jeu=$id");
    header('location:../pages/admin.php');
}
