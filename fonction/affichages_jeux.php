<?php

// affiche des jeux de la base de donées de la table "liste_jeux" en card 

function affichage_categorie()
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=jeux_video',
        "root",
        ""
    );

    $resultat = $bdd->query('SELECT * FROM liste_jeux ORDER BY nom ASC');
    $htmlAffichage = '<div class="d-flex flex-wrap">';
    while ($table = $resultat->fetch(PDO::FETCH_ASSOC)) {
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
    $htmlAffichage .= '</div>';
    return $htmlAffichage;
}

// affiche des jeux de la base de donées de la table "sorties_recentes" en card 

function affichage_nouvautes()
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=jeux_video',
        "root",
        ""
    );

    $resultat = $bdd->query('SELECT * FROM sorties_recentes ORDER BY nom ASC');
    $htmlAffichage = '<div class="d-flex flex-wrap">';
    while ($table = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $htmlAffichage .=
            '<div class="card m-2 mx-auto ms-2" style="width: 14rem; background:#212529">
                    <a href="../pages/jeu.php?jeu_nouvautes=' . $table['id_jeu'] . '" class="text-decoration-none">
                        <img src="' . $table['img_jaquette'] . '" class="card-img-top" alt="image jacket ' . $table['nom'] . '" height="345px" width="230px">
                        <div class="card-body">
                            <h5 class="card-title" style="color:white">' . $table['nom'] . '</h5>
                            <p class="lead" style="color:white">' . $table['genre']  . '</p>
                        </div>
                    </a>
                </div>';
    }
    $htmlAffichage .= '</div>';
    return $htmlAffichage;
}

// affiche des jeux de la base de donées de la table "jeux_populaires" en card 

function affichage_jeux_populaires()
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=jeux_video',
        "root",
        ""
    );

    $resultat = $bdd->query('SELECT * FROM jeux_populaires ORDER BY nom ASC');
    $htmlAffichage = '<div class="d-flex flex-wrap">';
    while ($table = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $htmlAffichage .=
            '<div class="card m-3 mx-auto ms-2" style="width: 14rem; background:#212529">
                    <a href="../pages/jeu.php?jeu_populaires=' . $table['id_jeu'] . '" class="text-decoration-none">
                        <img src="' . $table['img_jaquette'] . '" class="card-img-top" alt="image jacket ' . $table['nom'] . '" height="345px" width="230px">
                        <div class="card-body">
                            <h5 class="card-title" style="color:white">' . $table['nom'] . '</h5>
                            <p class="lead" style="color:white">' . $table['genre']  . '</p>
                        </div>
                    </a>
                </div>';
    }
    $htmlAffichage .= '</div>';
    return $htmlAffichage;
}
