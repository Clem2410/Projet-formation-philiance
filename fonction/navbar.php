<?php

// navbar pas fini

function navbar()
{

  $html = '<nav id="navbar" class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
             <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              <a class="navbar-brand ms-2 ms-auto icon_compte" href="../pages/index.php">
                <img src="../assets/image/logo.webp" alt="" width="75" height="75" class="rounded-circle">
              </a>
              <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <form class="d-flex ms-5" action="../pages/recherche.php" method="POST">
                <input class="form-control me-2 " type="search" placeholder="Recherche" aria-label="Search" name="search">
                  <button class="btn btn-outline-light" type="submit">Rechercher</button>
                    </form>
                      <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item ms-3">
                          <a class="nav-link active" aria-current="page" href="../pages/categorie.php">Catégories</a>
                        </li>
                        <li class="nav-item ms-3">
                          <a class="nav-link active" href="../pages/nouveautes.php">Nouveautés</a>
                        </li>
                        <li class="nav-item ms-3">
                          <a class="nav-link active" href="../pages/jeux_populaires.php">Jeux populaire</a>
                        </li>
                        <li class="nav-item ms-3">
                          <a class="nav-link active" href="../pages/articles.php">Articles</a>
                        </li>
                      </ul>
                    </div>
                    <a class="ms-auto" href="../pages/compte_utilisateur.php">
                      <svg style="color: #F5F5E8" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                      </svg>
                    </a>
                  </div>
                </nav>
';
  return $html;
}
