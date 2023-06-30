<?php
require_once "../fonction/navbar.php";
require_once "../fonction/footer.php";
?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,100,0,-25" />
    <title>Inscription</title>
</head>

<body style="background-image: linear-gradient(to right, #212529, #517873); font-size: 1.5em;">

    <?php
    // appel navbar
    echo navbar();

    ?>


    <div class="login-form">
        <?php
        if (isset($_GET['reg_err'])) {
            $err = htmlspecialchars($_GET['reg_err']);

            switch ($err) {

                case 'password':
        ?>
                    <div class="alert alert-danger">
                        <strong>Erreur :</strong> mot de passe différent
                    </div>
                <?php
                    break;

                case 'email':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur :</strong> email non valide
                    </div>
                <?php
                    break;

                case 'email_length':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur :</strong> email trop long
                    </div>
                <?php
                    break;

                case 'pseudo_length':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur :</strong> pseudo trop long
                    </div>
                <?php
                case 'already':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur :</strong> compte deja existant
                    </div>
        <?php

            }
        }
        ?>

        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <div class="mb-md-5 mt-md-4 pb-5">

                                    <h1>Inscription</h1>
                                    <p class="text-white-50 mb-5">Merci de vous inscrire pour acceder à votre compte</p>
                                    <div class="container">
                                        <div class="login-left">
                                            <div class="login-header">
                                            </div>


                                            <form action="../fonction/inscription_traitement.php" method="post">
                                                <div class="login-form-content">

                                                    <div class="form-item m-2">
                                                        <label for="identifiant">Pseudo</label>
                                                        <input type="text" name="pseudo" class="form-control form-control-lg" placeholder="Entrez un pseudo" required="required" autocomplete="off">


                                                        <div class="form-item m-2">
                                                            <label for="email">Email</label>
                                                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Entrez votre email" required="required" autocomplete="off">


                                                            <div class="form-item m-2">
                                                                <label for="mdp">Mot de passe</label>
                                                                <input type="password" name="password" class="form-control form-control-lg" placeholder="Entrez un mot de passe" required="required" autocomplete="off">

                                                                <div class="form-item m-2">
                                                                    <input type="password" name="password_retype" class="form-control form-control-lg" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-outline-light btn-lg px-6 m-3" name="inscription" type="submit">S'inscrire</button>

                                                        </div>

                                                        <div>
                                                            <p class="mb-0">Vous avez déjà un compte ? <a href="../pages/page_connexion.php" class="text-white-50 fw-bold">Se connecter</a>
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>

        </section>
        <?php
        echo footer();
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>