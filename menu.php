<?php
session_start();
$titre = "menu";
$lignes = file(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'menu.tsv');
foreach ($lignes as $k => $ligne) { // $k pour l'index
    $lignes[$k] = explode("\t", trim($ligne));
}

include "pages/header.php";
?>

<main class=" container mt-3 ms-6">
    <h1 class="text-center">Le menu</h1>

    <?php foreach ($lignes as $ligne) : ?>
        <?php if (count($ligne) === 1) : ?>
            <u><h3><?= $ligne[0] ?></u></h3>
        <?php else : ?>
            <div class="row">
                <div class="col-sm-8">
                    <p>
                        <strong><?= $ligne[0]; ?></strong><br>
                        <?= $ligne[1]; ?>
                    </p>
                </div>
                <div class="col-sm-4">
                <strong><?= number_format($ligne[2], 2, ',', ' '); ?> € </strong>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</main>

<?php include "pages/footer.php" ?>