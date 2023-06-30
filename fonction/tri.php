<?php

function condition_tri($var_nom)
{
    if (empty($_POST)) {
        if ($var_nom === "categorie") {
            echo affichage_categorie();
        } else if ($var_nom === "jeux_populaires") {
            echo affichage_jeux_populaires();
        } else if ($var_nom === "nouvautes") {
            echo affichage_nouvautes();
        }
    } else if (isset($_POST['genre']) || isset($_POST['type']) || isset($_POST['platforme'])) {

        if (!empty($_POST['genre'])) {
            $checked_genre = array();
            $checked_genre = $_POST['genre'];
        } else {
            $checked_genre = null;
        }

        if (!empty($_POST['type'])) {
            $checked_type = array();
            $checked_type = $_POST['type'];
        } else {
            $checked_type = null;
        }

        if (!empty($_POST['plateforme'])) {
            $checked_plateforme = array();
            $checked_plateforme = $_POST['plateforme'];
        } else {
            $checked_plateforme = null;
        }
        if ($var_nom === "categorie") {
            echo affichage_categorie_tri($checked_genre, $checked_type, $checked_plateforme, $var_nom);
        } else if ($var_nom === "jeux_populaires") {
            echo affichage_jeux_populaires_tri($checked_genre, $checked_type, $checked_plateforme, $var_nom);
        } else if ($var_nom === "nouvautes") {
            echo affichage_nouvautes_tri($checked_genre, $checked_type, $checked_plateforme, $var_nom);
        }
    } else {
        if ($var_nom === "categorie") {
            echo affichage_categorie();
        } else if ($var_nom === "jeux_populaires") {
            echo affichage_jeux_populaires();
        } else if ($var_nom === "nouvautes") {
            echo affichage_nouvautes();
        }
    }
}


function affichage_categorie_tri($var_genre, $var_type, $var_plateforme, $var_nom)
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=jeux_video',
        "root",
        ""
    );
    $resultat = $bdd->query('SELECT * FROM liste_jeux ORDER BY nom ASC');

    $htmlAffichage = '<div class="d-flex flex-wrap">';
    $arrayid = array();

    while ($table = $resultat->fetch(PDO::FETCH_ASSOC)) {

        if (($var_genre !== null || $var_type !== null || $var_plateforme !== null)
            && array_key_exists('genre', $table)
            && array_key_exists('type', $table)
            && array_key_exists('plateformes', $table)
        ) {
            $genre = $table['genre'];
            $genreArray = explode(', ', $genre);

            $type = $table['type'];
            $typeArray = explode(', ', $type);

            $plateforme = $table['plateformes'];
            $plateformeArray = explode(', ', $plateforme);

            if (($var_genre !== null && count(array_intersect($var_genre, $genreArray)) == count($var_genre))
                || ($var_type !== null && count(array_intersect($var_type, $typeArray)) == count($var_type))
                || ($var_plateforme !== null && count(array_intersect($var_plateforme, $plateformeArray)) == count($var_plateforme))
            ) {
                if (!in_array($table['id_jeu'], $arrayid)) {

                    $htmlAffichage .=
                        '<div class="card m-3 mx-auto ms-2" style="width: 14rem; background:#212529">
                <a href="../pages/jeu.php?jeu=' . $table['id_jeu'] . '" class="text-decoration-none">
                    <img src="' . $table['img_jaquette'] . '" class="card-img-top" alt="image jacket ' . $table['nom'] . '" height="345px" width="230px">
                    <div class="card-body">
                        <h5 class="card-title" style="color:white">' . $table['nom'] . '</h5>
                        <p class="lead" style="color:white">' . $table['genre'] . '</p>
                    </div>
                </a>
            </div>';
                    array_push($arrayid, $table['id_jeu']);
                }
            }
        }
    }
    if (empty($arrayid)) {
        $htmlAffichage = '<div class="text-center my-5"><p style="color: white;">Il n\'y a aucun jeu avec ces critères</p></div>';
    }
    $htmlAffichage .= '</div>';
    return $htmlAffichage;
}


function affichage_jeux_populaires_tri($var_genre, $var_type, $var_plateforme)
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=jeux_video',
        "root",
        ""
    );
    $resultat = $bdd->query('SELECT * FROM jeux_populaires ORDER BY nom ASC');

    $htmlAffichage = '<div class="d-flex flex-wrap">';
    $arrayid = array();

    while ($table = $resultat->fetch(PDO::FETCH_ASSOC)) {

        if (($var_genre !== null || $var_type !== null || $var_plateforme !== null)
            && array_key_exists('genre', $table)
            && array_key_exists('type', $table)
            && array_key_exists('plateformes', $table)
        ) {
            $genre = $table['genre'];
            $genreArray = explode(', ', $genre);

            $type = $table['type'];
            $typeArray = explode(', ', $type);

            $plateforme = $table['plateformes'];
            $plateformeArray = explode(', ', $plateforme);

            if (($var_genre !== null && count(array_intersect($var_genre, $genreArray)) == count($var_genre))
                || ($var_type !== null && count(array_intersect($var_type, $typeArray)) == count($var_type))
                || ($var_plateforme !== null && count(array_intersect($var_plateforme, $plateformeArray)) == count($var_plateforme))
            ) {
                if (!in_array($table['id_jeu'], $arrayid)) {

                    $htmlAffichage .=
                        '<div class="card m-3 mx-auto ms-2" style="width: 14rem; background:#212529">
                <a href="../pages/jeu.php?jeu_populaires=' . $table['id_jeu'] . '" class="text-decoration-none">
                    <img src="' . $table['img_jaquette'] . '" class="card-img-top" alt="image jacket ' . $table['nom'] . '" height="345px" width="230px">
                    <div class="card-body">
                        <h5 class="card-title" style="color:white">' . $table['nom'] . '</h5>
                        <p class="lead" style="color:white">' . $table['genre'] . '</p>
                    </div>
                </a>
            </div>';
                    array_push($arrayid, $table['id_jeu']);
                }
            }
        }
    }

    if (empty($arrayid)) {
        $htmlAffichage = '<div class="text-center"><p style="color: white;">Il n\'y a aucun jeu avec ces critères</p></div>';
    }

    $htmlAffichage .= '</div>';
    return $htmlAffichage;
}


function affichage_nouvautes_tri($var_genre, $var_type, $var_plateforme)
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=jeux_video',
        "root",
        ""
    );

    $resultat = $bdd->query('SELECT * FROM sorties_recentes ORDER BY nom ASC');
    $htmlAffichage = '<div style="color: white;">';
    if (isset($var_genre) && $var_genre !== null) {
        $genre_var = implode(", ", $var_genre);
        $htmlAffichage .= "<p> Genres : $genre_var </p><br>";
    }
    if (isset($var_type) && $var_type !== null) {
        $type_var = implode(", ", $var_type);
        $htmlAffichage .= "<p> Types : $type_var </p><br>";
    }

    if (isset($var_plateforme) && $var_plateforme !== null) {
        $plateforme_var = implode(", ", $var_plateforme);
        $htmlAffichage .= "<p> Plateformes :  $plateforme_var </p>";
    }

    $htmlAffichage .= '<div class="d-flex flex-wrap">';

    $arrayid = array();

    while ($table = $resultat->fetch(PDO::FETCH_ASSOC)) {

        if (($var_genre !== null || $var_type !== null || $var_plateforme !== null)
            && array_key_exists('genre', $table)
            && array_key_exists('type', $table)
            && array_key_exists('plateformes', $table)
        ) {

            $genre = $table['genre'];
            $genreArray = explode(', ', $genre);

            $type = $table['type'];
            $typeArray = explode(', ', $type);

            $plateforme = $table['plateformes'];
            $plateformeArray = explode(', ', $plateforme);

            if (($var_genre !== null && count(array_intersect($var_genre, $genreArray)) == count($var_genre))
                || ($var_type !== null && count(array_intersect($var_type, $typeArray)) == count($var_type))
                || ($var_plateforme !== null && count(array_intersect($var_plateforme, $plateformeArray)) == count($var_plateforme))
            ) {
                if (!in_array($table['id_jeu'], $arrayid)) {

                    $htmlAffichage .=
                        '<div class="card m-3 mx-auto ms-2" style="width: 14rem; background:#212529">
                <a href="../pages/jeu.php?jeu_nouvautes=' . $table['id_jeu'] . '" class="text-decoration-none">
                    <img src="' . $table['img_jaquette'] . '" class="card-img-top" alt="image jacket ' . $table['nom'] . '" height="345px" width="230px">
                    <div class="card-body">
                        <h5 class="card-title" style="color:white">' . $table['nom'] . '</h5>
                        <p class="lead" style="color:white">' . $table['genre'] . '</p>
                    </div>
                </a>
            </div>';
                    array_push($arrayid, $table['id_jeu']);
                }
            }
        }
    }

    if (empty($arrayid)) {
        $htmlAffichage = '<div class="text-center my-5"><p style="color: white;">Il n\'y a aucun jeu avec ces critères</p></div>';
    }

    $htmlAffichage .= '</div>';
    return $htmlAffichage;
}


function affichage_trier_nom($var_nom)
{

    $bdd = new PDO(
        'mysql:host=localhost;dbname=jeux_video',
        "root",
        ""
    );

    $resultat = $bdd->query('SELECT * FROM liste_jeux ORDER BY nom ASC');

    $htmlAffichage = '<div class="d-flex flex-wrap">';
    $arrayid = array();

    while ($table = $resultat->fetch(PDO::FETCH_ASSOC)) {

        if (($var_nom !== null) && array_key_exists('nom', $table)) {

            $varNomString = implode(" ", $var_nom);
            $varnomChanger = str_replace(array("'", ":", "-"), " ", $varNomString);
            $varnomChanger = strtolower($varnomChanger);

            $nom = $table['nom'];
            $nomChanger = str_replace(array("'", ":", "-"), " ", $nom);
            $nomChanger = strtolower($nomChanger);

            if ($var_nom !== null && strpos($nomChanger, $varnomChanger) !== false) {
                if (!in_array($table['id_jeu'], $arrayid)) {
                    $htmlAffichage .=
                        '<div class="card m-3 mx-auto ms-2" style="width: 14rem; background:#212529">
                <a href="../pages/jeu.php?jeu=' . $table['id_jeu'] . '" class="text-decoration-none">
                    <img src="' . $table['img_jaquette'] . '" class="card-img-top" alt="image jacket ' . $table['nom'] . '" height="345px" width="230px">
                    <div class="card-body">
                        <h5 class="card-title" style="color:white">' . $table['nom'] . '</h5>
                        <p class="lead" style="color:white">' . $table['genre'] . '</p>
                    </div>
                </a>
            </div>';
                    array_push($arrayid, $table['id_jeu']);
                }
            }
        }
    }
    $htmlAffichage .= '</div>';

    if (empty($arrayid)) {
        $htmlAffichage = '<div class="text-center my-5"><p style="color: white;">Il n\'y a aucun jeu avec ce nom</p></div>';
    }

    return $htmlAffichage;
}
