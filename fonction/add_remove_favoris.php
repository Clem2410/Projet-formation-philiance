<?php
require_once '../config.php';

session_start();

$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
$req->execute(array($_SESSION['user']));
$data = $req->fetch();

$favorisArray = explode(" ", $data['favoris']);

if (isset($_GET['add']) && is_numeric($_GET['jeu'])) {

    if (isset($_SESSION['user'])) {
        $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
        $req->execute(array($_SESSION['user']));
        $data = $req->fetch();

        $favorisArray = explode(" ", $data['favoris']);
    }

    array_push($favorisArray, $_GET['jeu']);

    $favorisEnd = implode(" ", $favorisArray);

    $sql_modif = "UPDATE utilisateurs SET favoris=:favoris WHERE id= :id";
    $stmt_t = $bdd->prepare($sql_modif);
    $data = [
        'id' => $data['id'],
        'favoris' => $favorisEnd,
    ];
    $stmt_t->execute($data);
} else if (isset($_GET['remove']) && is_numeric($_GET['jeu'])) {
    if (isset($_SESSION['user'])) {
        $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
        $req->execute(array($_SESSION['user']));
        $data = $req->fetch();

        $favorisArray = explode(" ", $data['favoris']);
    }

    $key = array_search($_GET['jeu'], $favorisArray);
    if ($key !== false) {
        unset($favorisArray[$key]);
    }

    $favorisEnd = implode(" ", $favorisArray);

    var_dump($favorisEnd);

    $sql_modif = "UPDATE utilisateurs SET favoris=:favoris WHERE id= :id";
    $stmt_t = $bdd->prepare($sql_modif);
    $data = [
        'id' => $data['id'],
        'favoris' => $favorisEnd,
    ];
    $stmt_t->execute($data);
}

header('location: ../pages/jeu.php?jeu=' . $_GET['jeu'] . '');
