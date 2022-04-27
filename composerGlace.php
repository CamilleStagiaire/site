<?php
session_start();
$titre = "glace";
include "pages/header.php";

$parfums = [
    "Fraise" => 4,
    "Chocolat" => 5,
    "Vanille" => 3
];
$cornets = [
    "Pot" => 2,
    "Cornet" => 3

];
$supplements = [
    "Pépites de chocolat" => 1,
    "Chantilly" => 0.5
];
$ingredients = [];
$total = 0;

foreach (['parfum', 'supplement', 'cornet'] as $name) {
    if (isset($_GET[$name])) {
        $liste = $name . 's';
        $choix = $_GET[$name];
        if (is_array($choix)) {
            foreach ($choix as $value) {
                if (isset($$liste[$value])) {
                    $ingredients[] = $value;
                    $total += $$liste[$value];
                }
            }
        } else {
            if (isset($$liste[$choix])) {
                $ingredients[] = $choix;
                $total += $$liste[$choix];
            }
        }
    }
}

?>

<main class="container">
    <h1 class="text-center mt-3">Composez votre glace</h1>
    <div class="row mt-3">
        <div class="col-md-8">
            <form action="composerGlace.php" method="GET">
                <h3>Choisissez vos parfums</h3>
                <?php foreach ($parfums as $parfum => $prix) : ?>
                    <div class="checkbox">
                        <label>
                            <?= checkbox("parfum", $parfum, $_GET) ?>
                            <?= $parfum ?> - <?= $prix ?> €
                        </label>
                    </div>
                <?php endforeach ?>
                <h3>Choisissez votre cornet</h3>
                <?php foreach ($cornets as $cornet => $prix) : ?>
                    <div class="checkbox">
                        <label>
                            <?= radio("cornet", $cornet, $_GET) ?>
                            <?= $cornet ?> - <?= $prix ?> €
                        </label>
                    </div>
                <?php endforeach ?>
                <h3>Choisissez vos supplements</h3>
                <?php foreach ($supplements as $supplement => $prix) : ?>
                    <div class="checkbox">
                        <label>
                            <?= checkbox("supplement", $supplement, $_GET) ?>
                            <?= $supplement ?> - <?= $prix ?> €
                        </label>
                    </div>
                <?php endforeach ?>
                <button type="submit" class="btn btn-primary mt-3">Composer ma glace</button>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Votre glace</h5>
                    <ul>
                        <?php foreach ($ingredients as $ingredient) : ?>
                            <li><?= $ingredient ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <p>
                        <strong>Prix : </strong> <?= $total ?> €
                    </p>
                </div>
            </div>


        </div>
    </div>
</main>


<?php include "pages/footer.php" ?>