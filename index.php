<?php
session_start();
$titre = "accueil";
include "pages/header.php";
?>

<main class="container text-center mt-3">
    <h1>Bienvenue sur mon site <?= $_SESSION['username'] ?? "" ?></h1>

    <div class="row">

        <div class="col-md-6 offset-3">
            <h3 class="mt-5 mb-5"> Devinez un nombre entre 1 et 100</h3>
            <div class="col-md-4 offset-4 mb-3">
                <input class="form-control" type="number" name="chiffre" placeholder="entrez un chiffre" value="" id="nombre">
            </div>
            <button class="btn btn-primary" type="button" id="btnDeviner">Deviner</button>
            <div id="afficherResultat"></div>
        </div>

    </div>
</main>

<?php include "pages/footer.php" ?>