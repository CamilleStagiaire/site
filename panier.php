<?php
session_start();
$titre = "panier";
include "pages/header.php";
?>

<main class="container text-center mt-3">

    <?php if (!empty($_SESSION['biere'])) : ?>
                <?php
                $panier = $_SESSION['biere'];
                $total = 0;
                ?>

                <h1 class="mb-5">Votre panier</h1>
                <table class="table table-striped">
                    <thead>
                        <th colspan="2">Articles</th>
                    </thead>
                    <tbody>
                        <?php foreach ($panier as $biere) : ?>
                            <?php $total += $biere['prix_achat']; ?>
                            <tr>
                                <td><?= $biere['nom_article'] ?> €</td>
                                <td><?= $biere['prix_achat'] ?> €</td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong> Total :</strong></td>
                            <td><strong><?= number_format($total, 2) ?> €</strong></td>
                        </tr>
                    </tfoot>
                </table>
            <?php endif ?>

            
    <form action="logoutPanier.php">
        <button type="submit" value="submit" class="btn btn-primary">Vider le panier</button>
    </form>
</main>

<?php include "pages/footer.php" ?>