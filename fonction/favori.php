<?php

function getIfInFavori($varConn)
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=jeux_video',
        "root",
        ""
    );

    if (isset($_SESSION['user'])) {
        $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
        $req->execute(array($_SESSION['user']));
        $data = $req->fetch();

        $favorisArray = explode(" ", $data['favoris']);
    }



    if ($varConn === true) {
        if (in_array($_GET['jeu'], $favorisArray)) {
            $html = '<form action="../fonction/add_remove_favoris.php?jeu=' . $_GET['jeu'] . '&remove" method="POST">
                        <button type="submit" name="removeFavoris" style="border: none; background: #212529;">
                            <img src="../assets/image/retrait_favoris.png" alt="image retrait favoris">
                        </button>
                    </form>';
        } else {
            $html = '<form action="../fonction/add_remove_favoris.php?jeu=' . $_GET['jeu']  . '&add" method="POST">
                        <button type="submit" name="addFavoris" style="border: none; background: #212529;">
                            <img type="submit" src="../assets/image/ajout_favoris.png" alt="image ajout favoris">
                        </button>
                    </form>';
        }
        return $html;
    }
}

function affichageJeuFavoris()
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=jeux_video',
        "root",
        ""
    );

    $resultat = $bdd->query('SELECT * FROM liste_jeux ORDER BY nom ASC');
    $htmlAffichage = '<div class="d-flex flex-wrap">';

    if (isset($_SESSION['user'])) {
        $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
        $req->execute(array($_SESSION['user']));
        $data = $req->fetch();

        $favorisArray = explode(" ", $data['favoris']);
    }



    while ($table = $resultat->fetch(PDO::FETCH_ASSOC)) {
        if (in_array($table['id_jeu'], $favorisArray)) {
            $htmlAffichage .=
                '<div class="card m-3 mx-auto ms-2" style="width: 14rem; background:#212529">
                    <a href="../pages/jeu.php?jeu=' . $table['id_jeu'] . '" class="text-decoration-none">
                        <img src="' . $table['img_jaquette'] . '" class="card-img-top" alt="image jacket ' . $table['nom'] . '" height="345px" width="230px">
                        <div class="card-body">
                            <h5 class="card-title" style="color:white">' . $table['nom'] . '</h5>
                            <p class="lead" style="color:white">' . $table['genre']  . '</p>
                        </div>
                    </a>
                </div>';
        }
    }
    $htmlAffichage .= '</div>';
    return $htmlAffichage;
}
