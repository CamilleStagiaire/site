<?php
session_start();
date_default_timezone_set("Europe/Paris");
$titre = "horaires";
include "pages/header.php";
?>

<main class=" container text-center fs-4 mt-3">
    <h1>Horaires</h1><br>

    <div class="tex-center">
        <?php if (ouvertureFermeture()) : ?>
            <div class="alert alert-success">
                Le magasin est ouvert
            </div>
        <?php else : ?>
            <div class="alert alert-danger">
                Le magasin est fermé
            </div>
        <?php endif ?>
    </div>

    <?= afficherHoraire("list-unstyled") ?>

</main>

<?php include "pages/footer.php" ?>