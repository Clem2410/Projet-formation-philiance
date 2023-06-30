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
    <title>Connexion</title>
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
                case 'success':
        ?>
                    <div class="alert alert-success">
                        <p> Inscription réussie !
                        <p>
                    </div>
        <?php
                    break;

                case 'password':
            }
        }
        ?>
        <?php
        if (isset($_GET['login_err'])) {
            $err = htmlspecialchars($_GET['login_err']);

            switch ($err) {
                case 'password':
        ?>
                    <div class="alert alert-danger">
                        <strong>Erreur :</strong> mot de passe incorrect
                    </div>
                <?php
                    break;

                case 'email':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur :</strong> email incorrect
                    </div>
                <?php
                    break;

                case 'already':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur :</strong> compte non existant
                    </div>
        <?php
                    break;
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

                                    <h1>Connexion</h1>
                                    <p class="text-white-50 mb-5">Merci de vous connecter pour acceder à votre compte</p>
                                    <div class="container">
                                        <div class="login-left">
                                            <div class="login-header">
                                            </div>
                                            <form class="login-form" action="../fonction/connexion.php" method="post">
                                                <div class="login-form-content">

                                                    <div class="form-item m-2">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">

                                                        <div class="form-item m-2">
                                                            <label for="mdp">Mot de passe</label>
                                                            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                                                        </div>
                                                        <button class="btn btn-outline-light btn-lg px-6 m-3" type="submit">Se connecter</button>

                                                    </div>

                                                    <div>
                                                        <p class="mb-0">Pas encore de compte ? <a href="../pages/inscription.php" class="text-white-50 fw-bold">S'inscrire</a>
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
</body>

</html>