<?php
session_start();
$titre = "connexion";

$erreur = null;

if (isset($_POST['username']) && isset($_POST['password'])) {
    $inputLogin = htmlentities($_POST['username']);
    $inputPassword = htmlentities($_POST['password']);

    $mysqli = mysqli_connect("localhost", "root", "", "tuto-php", 3306) or die("Erreur de connexion à la base de données");
    $query = mysqli_prepare($mysqli, "SELECT * FROM user WHERE username = ?");
    mysqli_stmt_bind_param($query, "s", $inputLogin);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    $user = mysqli_fetch_assoc($result);


    if ($user !== null) {
        if (password_verify($inputPassword, $user['password'])) {
            $_SESSION['username'] = $inputLogin;
        } else {
            $erreur = "Votre mot de passe est incorrect";
        }
    } else {
        $erreur = "Votre Pseudo est inconnu";
    }
}

include "pages/header.php";
?>

<main class="container text-center mt-3">
    <h1>Connexion</h1>

    <?php if (!empty($_SESSION['username'])) : ?>
        <div class="alert alert-success mt-3 col-md-6 offset-3">
            <h2> Bienvenue <?= $_SESSION['username'] ?></h2>
        </div>
        <form action="logout.php">
        <button type="submit" value="submit" class="btn btn-primary">Se déconnecter</button>
    </form>

    <?php else : ?>
        <div class="text-center col-md-4 offset-4">
            <form action="" method="post">
                <div class="md-3">
                    <label class="form-label">Pseudo</label>
                    <input class="form-control" type="text" name="username" placeholder="Entrez un pseudo" value="<?= $inputLogin ?? "" ?>">
                </div>
                <div class="md-3">
                    <label class="form-label">Mot de passe</label>
                    <input class="form-control" type="password" name="password" placeholder="Entrez votre mot de passe">
                </div>

                <?php if ($erreur) : ?>
                    <div class="alert alert-danger mt-3">
                        <?= $erreur ?>
                    </div>
                <?php endif ?>

                <button type="submit" class="btn btn-primary mt-3">Se connecter</button>
                <a href="register.php" class="btn btn-success mt-3">Créer un compte</a>
            </form>

        </div>
    <?php endif ?>
</main>

<?php include "pages/footer.php" ?>