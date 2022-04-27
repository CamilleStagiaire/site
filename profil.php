<?php
session_start();

$titre = "profil";
include "pages/header.php";
?>

<main class="container text-center mt-3">
<?php if (!empty($_SESSION['username'])) : ?>
    <div class="alert alert-success mt-3">
                  <h1> Hello <?= $_SESSION['username'] ?></h1>
                </div>
    <?php endif ?>

    <form action="logout.php">
        <button type="submit" value="submit" class="btn btn-primary">Se déconnecter</button>
    </form>
</main>

<?php include "pages/footer.php" ?>