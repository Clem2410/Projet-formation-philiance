<?php

function admin_affichage()
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=jeux_video',
        "root",
        ""
    );

    $resultat = $bdd->query('SELECT * FROM liste_jeux');

    $htmlAffichage = "";

    $htmlAffichage .= '<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nom</th>
        <th scope="col">Genres</th>
        <th scope="col">Developpeur</th>
        <th scope="col">plateformes</th>
        <th scope="col">Types</th>
        <th scope="col">Date de sortie</th>
        <th scope="col">Modifier</th>
        <th scope="col">Supprimer</th>
      </tr>
    </thead>
    <tbody>';

    while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $htmlAffichage .= '<tr>
        <td>' . $ligne['id_jeu'] . '</td>
        <td>' . $ligne['nom'] . '</td>
        <td>' . $ligne['genre'] . '</td>
        <td>' . $ligne['developpeur'] . '</td>
        <td>' . $ligne['plateformes'] . '</td>
        <td>' . $ligne['type'] . '</td>
        <td>' . $ligne['date_sortie'] . '</td>
        <td><a href="../pages/admin_modif_jeu.php?id_jeu=' . $ligne['id_jeu'] . '" class="btn btn-primary">Modifier</a></td>
        <td><a href="../pages/admin_delete_jeu.php?id_jeu=' . $ligne['id_jeu'] . '" class="btn btn-danger" onclick="return confirm(\'ATTENTION : êtes vous sûr de vouloir supprimer ce jeu ?\');">Supprimer</a></td></tr>';
    }
    $htmlAffichage .= '</tbody></table><br>';
    return $htmlAffichage;
}




function ajout()
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=jeux_video',
        "root",
        ""
    );


    if (isset($_POST["submit"])) {
        $cle = ['nom', 'description', 'genre', 'developpeur', 'plateformes', 'type', 'date_sortie', 'lien_video', 'note', 'lien_achat'];
        $cleVerif = "";
        foreach ($cle as $valeur) {
            if (!isset($_POST[$valeur]) || empty($_POST[$valeur])) {
                $cleVerif = $valeur;
                break;
            }
        }

        $tableImg = array('lien_img_jeu_1', 'lien_img_jeu_2', 'lien_img_jeu_3');

        $resultsTableImg  = [];
        if (isset($_FILES['lien_img_jaquette']) && $_FILES['lien_img_jaquette']['error'] == 0) {
            if ($_FILES['lien_img_jaquette']['size'] <= 1000000) {

                //Verification de l'extension
                $infofile = pathinfo($_FILES['lien_img_jaquette']['name']);
                $extension = $infofile['extension'];
                $extension_allowed = array('jpg', 'jpeg', 'gif', 'png', 'webp');

                if (in_array($extension, $extension_allowed)) {

                    $source = $_FILES['lien_img_jaquette']['tmp_name'];


                    $destination = '../assets/image/img_jaquette/' . $_FILES['lien_img_jaquette']['name'];

                    move_uploaded_file($source, $destination);
                    $resultsTableImg['lien_img_jaquette'] = $destination;
                } else {
                    die("Extension de fichier non autorisée !");
                }
            } else {
                die("Le fichier est trop lourd (>1Mo) !");
            }
        }

        foreach ($tableImg as $img) {
            if (isset($_FILES[$img]) && $_FILES[$img]['error'] == 0) {
                if ($_FILES[$img]['size'] <= 1000000) {

                    //Verification de l'extension
                    $infofile = pathinfo($_FILES[$img]['name']);
                    $extension = $infofile['extension'];
                    $extension_allowed = array('jpg', 'jpeg', 'gif', 'png', 'webp');

                    if (in_array($extension, $extension_allowed)) {

                        $source = $_FILES[$img]['tmp_name'];

                        $destination = '../assets/image/img_jeux/' . $_FILES[$img]['name'];
                        $filename = $_FILES[$img]['name'];

                        move_uploaded_file($source, $destination);
                        $resultsTableImg[$img] = $destination;
                    } else {
                        die("Extension de fichier non autorisée !");
                    }
                } else {
                    die("Le fichier est trop lourd (>1Mo) !");
                }
            }
        }

        if ($cleVerif != "") {
            $html = "Vous n'avez pas rempli le champ $cleVerif";
            return $html;
        } else {
            $sql_requete_prepare = "INSERT INTO liste_jeux (nom, description, genre, developpeur, plateformes, type, date_sortie, img_jaquette, lien_video, lien_img_jeu_1, lien_img_jeu_2, lien_img_jeu_3, note, lien_achat)
                    VALUES(:nom, :description, :genre, :developpeur, :plateformes, :type, :date_sortie, :img_jaquette, :lien_video, :lien_img_jeu_1, :lien_img_jeu_2, :lien_img_jeu_3, :note , :lien_achat)";
            $stmt = $bdd->prepare($sql_requete_prepare);
            $stmt->execute([
                'nom' => $_POST['nom'],
                'description' => $_POST['description'],
                'genre' => $_POST['genre'],
                'developpeur' => $_POST['developpeur'],
                'plateformes' => $_POST['plateformes'],
                'type' => $_POST['type'],
                'date_sortie' => $_POST['date_sortie'],
                'img_jaquette' => "",
                'lien_video' => $_POST['lien_video'],
                'lien_img_jeu_1' => "",
                'lien_img_jeu_2' => "",
                'lien_img_jeu_3' => "",
                'note' => $_POST['note'],
                'lien_achat' => $_POST['lien_achat'],
            ]);

            #Recuperer le dernier Id enregsitré avec lastInsertId()
            $lastid = $bdd->lastInsertId();

            #Upload jacket
            if (isset($resultsTableImg['lien_img_jaquette']) && !is_null($resultsTableImg['lien_img_jaquette'])) {
                $sql_modif_jaquette = "UPDATE liste_jeux SET img_jaquette=:img_jaquette WHERE id_jeu = :id_jeu";
                $img_jaq = $bdd->prepare($sql_modif_jaquette);
                $img_jaquette = [
                    'id_jeu' => $lastid,
                    'img_jaquette' => $resultsTableImg['lien_img_jaquette']
                ];
                $img_jaq->execute($img_jaquette);
            }

            #Upload img1
            if (isset($resultsTableImg['lien_img_jeu_1']) && !is_null($resultsTableImg['lien_img_jeu_1'])) {
                $sql_modif_img_1 = "UPDATE liste_jeux SET lien_img_jeu_1=:lien_img_jeu_1 WHERE id_jeu =:id_jeu";
                $jeu_1 = $bdd->prepare($sql_modif_img_1);
                $img_jeu_1 = [
                    'id_jeu' => $lastid,
                    'lien_img_jeu_1' => $resultsTableImg['lien_img_jeu_1']
                ];
                $jeu_1->execute($img_jeu_1);
            }

            #Upload img2
            if (isset($resultsTableImg['lien_img_jeu_2']) && !is_null($resultsTableImg['lien_img_jeu_2'])) {
                $sql_modif_img_2 = "UPDATE liste_jeux SET lien_img_jeu_2=:lien_img_jeu_2 WHERE id_jeu =:id_jeu";
                $jeu_2 = $bdd->prepare($sql_modif_img_2);
                $img_jeu_2 = [
                    'id_jeu' => $lastid,
                    'lien_img_jeu_2' => $resultsTableImg['lien_img_jeu_2']
                ];
                $jeu_2->execute($img_jeu_2);
            }

            #Upload img3
            if (isset($resultsTableImg['lien_img_jeu_3']) && !is_null($resultsTableImg['lien_img_jeu_3'])) {
                $sql_modif_img_3 = "UPDATE liste_jeux SET lien_img_jeu_3=:lien_img_jeu_3 WHERE id_jeu =:id_jeu";
                $jeu_3 = $bdd->prepare($sql_modif_img_3);
                $img_jeu_3 = [
                    'id_jeu' => $lastid,
                    'lien_img_jeu_3' => $resultsTableImg['lien_img_jeu_3'],

                ];
                $jeu_3->execute($img_jeu_3);
            }











            header('location:../pages/admin.php');
        }
    }
}







function modif()
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=jeux_video',
        "root",
        ""
    );


    $tableImg = array('lien_img_jeu_1', 'lien_img_jeu_2', 'lien_img_jeu_3');

    $resultsTableImg  = [];
    if (isset($_FILES['lien_img_jaquette']) && $_FILES['lien_img_jaquette']['error'] == 0) {
        if ($_FILES['lien_img_jaquette']['size'] <= 1000000) {

            //Verification de l'extension
            $infofile = pathinfo($_FILES['lien_img_jaquette']['name']);
            $extension = $infofile['extension'];
            $extension_allowed = array('jpg', 'jpeg', 'gif', 'png', 'webp');

            if (in_array($extension, $extension_allowed)) {

                $source = $_FILES['lien_img_jaquette']['tmp_name'];


                $destination = '../assets/image/img_jaquette/' . $_FILES['lien_img_jaquette']['name'];

                move_uploaded_file($source, $destination);

                $resultsTableImg['lien_img_jaquette'] = $destination;
            } else {
                die("Extension de fichier non autorisée !");
            }
        } else {
            die("Le fichier est trop lourd (>1Mo) !");
        }
    }
    foreach ($tableImg as $img) {
        if (isset($_FILES[$img]) && $_FILES[$img]['error'] == 0) {
            if ($_FILES[$img]['size'] <= 1000000) {

                //Verification de l'extension
                $infofile = pathinfo($_FILES[$img]['name']);
                $extension = $infofile['extension'];
                $extension_allowed = array('jpg', 'jpeg', 'gif', 'png', 'webp');

                if (in_array($extension, $extension_allowed)) {

                    $source = $_FILES[$img]['tmp_name'];

                    $destination = '../assets/image/img_jeux/' . $_FILES[$img]['name'];
                    $filename = $_FILES[$img]['name'];

                    move_uploaded_file($source, $destination);
                    $resultsTableImg[$img] = $destination;
                } else {
                    die("Extension de fichier non autorisée !");
                }
            } else {
                die("Le fichier est trop lourd (>1Mo) !");
            }
        }
    }

    $sql_modif = "UPDATE liste_jeux SET nom=:nom, description=:description, genre=:genre, developpeur=:developpeur, plateformes=:plateformes, type=:type, date_sortie=:date_sortie, lien_video=:lien_video, note=:note, lien_achat=:lien_achat WHERE id_jeu= :id_jeu";
    $stmt_t = $bdd->prepare($sql_modif);
    $data = [
        'id_jeu' => $_POST['id_hidden'],
        'nom' => $_POST['nom'],
        'description' => $_POST['description'],
        'genre' => $_POST['genre'],
        'developpeur' => $_POST['developpeur'],
        'plateformes' => $_POST['plateformes'],
        'type' => $_POST['type'],
        'date_sortie' => $_POST['date_sortie'],
        'lien_video' => $_POST['lien_video'],
        'note' => $_POST['note'],
        'lien_achat' => $_POST['lien_achat'],
    ];
    $stmt_t->execute($data);

    #Upload jacket
    if (isset($resultsTableImg['lien_img_jaquette']) && !is_null($resultsTableImg['lien_img_jaquette'])) {
        $sql_modif_jaquette = "UPDATE liste_jeux SET img_jaquette=:img_jaquette WHERE id_jeu = :id_jeu";
        $img_jaq = $bdd->prepare($sql_modif_jaquette);
        $img_jaquette = [
            'id_jeu' => $_POST['id_hidden'],
            'img_jaquette' => $resultsTableImg['lien_img_jaquette']
        ];
        $img_jaq->execute($img_jaquette);
    }

    #Upload img1
    if (isset($resultsTableImg['lien_img_jeu_1']) && !is_null($resultsTableImg['lien_img_jeu_1'])) {
        $sql_modif_img_1 = "UPDATE liste_jeux SET lien_img_jeu_1=:lien_img_jeu_1 WHERE id_jeu =:id_jeu";
        $jeu_1 = $bdd->prepare($sql_modif_img_1);
        $img_jeu_1 = [
            'id_jeu' => $_POST['id_hidden'],
            'lien_img_jeu_1' => $resultsTableImg['lien_img_jeu_1']
        ];
        $jeu_1->execute($img_jeu_1);
    }

    #Upload img2
    if (isset($resultsTableImg['lien_img_jeu_2']) && !is_null($resultsTableImg['lien_img_jeu_2'])) {
        $sql_modif_img_2 = "UPDATE liste_jeux SET lien_img_jeu_2=:lien_img_jeu_2 WHERE id_jeu =:id_jeu";
        $jeu_2 = $bdd->prepare($sql_modif_img_2);
        $img_jeu_2 = [
            'id_jeu' => $_POST['id_hidden'],
            'lien_img_jeu_2' => $resultsTableImg['lien_img_jeu_2']
        ];
        $jeu_2->execute($img_jeu_2);
    }

    #Upload img3
    if (isset($resultsTableImg['lien_img_jeu_3']) && !is_null($resultsTableImg['lien_img_jeu_3'])) {
        $sql_modif_img_3 = "UPDATE liste_jeux SET lien_img_jeu_3=:lien_img_jeu_3 WHERE id_jeu =:id_jeu";
        $jeu_3 = $bdd->prepare($sql_modif_img_3);
        $img_jeu_3 = [
            'id_jeu' => $_POST['id_hidden'],
            'lien_img_jeu_3' => $resultsTableImg['lien_img_jeu_3'],

        ];
        $jeu_3->execute($img_jeu_3);
    }

    header('location:../pages/admin.php');
}

function admin_affichage_trier_nom($var_nom)
{

    $bdd = new PDO(
        'mysql:host=localhost;dbname=jeux_video',
        "root",
        ""
    );

    $resultat = $bdd->query('SELECT * FROM liste_jeux ORDER BY nom ASC');

    $htmlAffichage = '<table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Genres</th>
                <th scope="col">Developpeur</th>
                <th scope="col">plateformes</th>
                <th scope="col">Types</th>
                <th scope="col">Date de sortie</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
              </tr>
            </thead>
            <tbody>';

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
                    $htmlAffichage .= '<tr>
                    <td>' . $table['id_jeu'] . '</td>
                    <td>' . $table['nom'] . '</td>
                    <td>' . $table['genre'] . '</td>
                    <td>' . $table['developpeur'] . '</td>
                    <td>' . $table['plateformes'] . '</td>
                    <td>' . $table['type'] . '</td>
                    <td>' . $table['date_sortie'] . '</td>
                    <td><a href="../pages/admin_modif_jeu.php?id_jeu=' . $table['id_jeu'] . '" class="btn btn-primary">Modifier</a></td>
                    <td><a href="../pages/admin_delete_jeu.php?id_jeu=' . $table['id_jeu'] . '" class="btn btn-danger" onclick="return confirm(\'ATTENTION : êtes vous sûr de vouloir supprimer ce jeu ?\');">Supprimer</a></td></tr>';
                    array_push($arrayid, $table['id_jeu']);
                }
            }
        }
    }
    $htmlAffichage .= '</tbody></table><br>';

    if (empty($arrayid)) {
        $htmlAffichage = " Il n'y a aucun jeu avec ces critères";
    }
    return $htmlAffichage;
}
