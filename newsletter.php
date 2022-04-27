<?php
session_start();
$titre = "newsletter";

$error = null;
$email = null;
$success = null;

if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'emails' . DIRECTORY_SEPARATOR . date('Y-m-d');
        file_put_contents($file, $email . PHP_EOL, FILE_APPEND);
        $success = "Votre email a bien été enregistré";
        $email = null;
    } else {
        $error = "Email invalide";
    }
}

include "pages/header.php";
?>

<main class=" container mt-3 ms-6">

    <h1 class="text-center mt-3 mb-3">S'inscrire à la newletter</h1>

    <?php if ($error) : ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <?php if ($success) : ?>
        <div class="alert alert-success">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form action="newsletter.php" method="POST" class="row">
        <div class="col-auto">
            <input class="form-control" type="email" name="email" placeholder="Entrez votre email" required value="<?= htmlentities($email) ?>">
        </div>
        <div class="col-auto">
            <button type="submit" value="submit" class="btn btn-primary">S'inscrire</button>

        </div>
    </form>

</main>

<?php include "pages/footer.php" ?>