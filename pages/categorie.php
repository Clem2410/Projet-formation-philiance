<?php
require_once "../config.php";
$pageNom = "categorie";
require_once "../fonction/navbar.php";
require_once "../fonction/affichages_jeux.php";
require_once "../fonction/tri.php";
require_once "../fonction/footer.php";
?>
<!DOCTYPE html>
<html lang="FR-fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,100,0,-25" />
    <title>Catégories</title>
</head>

<body style="background-image: linear-gradient(to right, #212529, #517873); font-size: 1.5em;">

    <?php
    // appel navbar
    echo navbar();
    ?>
    <form action="../pages/categorie.php" method="POST" class="d-flex ">
        <div class="dropdown m-3">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Catégories
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <div class="d-flex">
                    <div class="m-5">
                        <h2>Genres</h2>
                        <li><input type="checkbox" name="genre[]" value="Action"> Action</li>
                        <li><input type="checkbox" name="genre[]" value="Aventure"> Aventure</li>
                        <li><input type="checkbox" name="genre[]" value="Beat'em up"> Beat'em up</li>
                        <li><input type="checkbox" name="genre[]" value="Course"> Course</li>
                        <li><input type="checkbox" name="genre[]" value="Fiction interactive"> Fiction interactive</li>
                        <li><input type="checkbox" name="genre[]" value="FPS"> FPS</li>
                        <li><input type="checkbox" name="genre[]" value="Infiltration"> Infiltration</li>
                        <li><input type="checkbox" name="genre[]" value="MOBA"> MOBA</li>
                        <li><input type="checkbox" name="genre[]" value="Point’n’click"> Point’n’click</li>
                        <li><input type="checkbox" name="genre[]" value="Plateforme"> Plateforme</li>
                        <li><input type="checkbox" name="genre[]" value="Réflexion"> Réflexion</li>
                        <li><input type="checkbox" name="genre[]" value="RPG"> RPG</li>
                        <li><input type="checkbox" name="genre[]" value="Roguelike"> Roguelike</li>
                        <li><input type="checkbox" name="genre[]" value="Shoot'em up"> Shoot'em up</li>
                        <li><input type="checkbox" name="genre[]" value="Survie"> Survie</li>
                        <li><input type="checkbox" name="genre[]" value="Survival horror"> Survival horror</li>
                        <li><input type="checkbox" name="genre[]" value="Tactique"> Tactique</li>
                    </div>
                    <div class="m-5">
                        <h2>Types</h2>
                        <li><input type="checkbox" name="type[]" value="AAA"> AAA</li>
                        <li><input type="checkbox" name="type[]" value="Coopération"> Coop</li>
                        <li><input type="checkbox" name="type[]" value="Collection"> Collection</li>
                        <li><input type="checkbox" name="type[]" value="Épisodique"> Épisodique</li>
                        <li><input type="checkbox" name="type[]" value="Exclusivité"> Exclusivité</li>
                        <li><input type="checkbox" name="type[]" value="Gratuit"> Gratuit</li>
                        <li><input type="checkbox" name="type[]" value="Indépendant"> Indépendant</li>
                    </div>
                    <div class="m-5">
                        <h2>Platformes</h2>
                        <li><input type="checkbox" name="plateforme[]" value="PC"> PC</li>
                        <li><input type="checkbox" name="plateforme[]" value="Switch"> Switch</li>
                        <li><input type="checkbox" name="plateforme[]" value="Xbox Series"> Xbox Series</li>
                        <li><input type="checkbox" name="plateforme[]" value="PS5"> PS5</li>
                        <li><input type="checkbox" name="plateforme[]" value="PS4"> PS4</li>
                        <li><input type="checkbox" name="plateforme[]" value="ONE"> ONE</li>
                        <li><input type="checkbox" name="plateforme[]" value="PS3"> PS3</li>
                        <li><input type="checkbox" name="plateforme[]" value="360"> 360</li>
                    </div>
                </div>
            </ul>
        </div>
        <div class="my-auto">
            <button type="submit" class="btn btn-secondary m-3" name="submit">Valider</button>
        </div>
    </form>
    <?php
    // appel de l'affichage des cards jeu
    condition_tri($pageNom);
    echo footer();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>