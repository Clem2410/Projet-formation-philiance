<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=jeux_video", "root", "");
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
