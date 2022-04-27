<?php
session_start();
$titre = "accueil";
include "pages/header.php";
$aDeviner = 50;
?>

<main class="container text-center mt-3">
    <h1>Page d'accueil</h1>
    <h3 class="mt-5 mb-5"> Devinez un nombre entre 1 et 100</h3>

    <div class="mb-3">
        <form action="index.php" method="GET">
            <input type="number" name="chiffre" placeholder="entrez un chiffre de 0 à 100" value="<?= $_GET['chiffre'] ?? 0 ?>">
            <input style="background-color:rgb(13,110,253); color:white" type="submit" value="deviner">
        </form>
    </div>

    <?php if (isset($_GET['chiffre'])) : ?>
        <?php if ($_GET['chiffre'] < $aDeviner) : ?>
            Le chiffre est trop petit
        <?php elseif ($_GET['chiffre'] > $aDeviner) : ?>
            Le chiffre est trop grand
        <?php elseif ($_GET['chiffre'] = $aDeviner) : ?>
            Vous avez trouvé
        <?php endif ?>
    <?php endif ?>
    
</main>

<?php include "pages/footer.php" ?>