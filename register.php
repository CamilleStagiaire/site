<?php
include "pages/header.php";
session_start();




$titre = "compte";

$success = null;
$erreur = null;



if (isset($_POST['username']) && isset($_POST['password'])) {

    if (!empty($_POST['username']) && !empty($_POST['password'])) {



        $inputLogin = htmlentities($_POST['username']);
        $inputPassword = htmlentities($_POST['password']);

        $mysqli = mysqli_connect("localhost", "root", "", "tuto-php", 3306) or die("Erreur de connexion à la base de données");

        if (verifUser($mysqli, $inputLogin)) {

            $erreur = "L'utilisateur existe déja dans la base de données";
        } else {
            $query = mysqli_prepare($mysqli, "INSERT INTO user(username, password) VALUES (?,?)");
            $mdpHash = password_hash($inputPassword,PASSWORD_BCRYPT);
            
            mysqli_stmt_bind_param($query, "ss", $inputLogin, $mdpHash);
            $exec = mysqli_stmt_execute($query);

            if ($exec !== false) {
                $_SESSION['username'] = $inputLogin;
                header('location: profil.php');
            } else {           
                $erreur = "erreur d'enregistrement";
            }
        }
    } else {
        $erreur = "Veuillez renseigner les informations";
    }
}




?>

<main class="container text-center mt-3">

    <h1 class="text-center mt-3">Créer un compte</h1>

    <div class="text-center col-md-4 offset-4">

        <form action="" method="POST">
            <div class="md-3">
                <label class="form-label">Pseudo</label>
                <input class="form-control" type="text" name="username" placeholder="Entrez un psuedo" value="<?= $inputLogin ?? "" ?>">
            </div>
            <div class="md-3">
                <label class="form-label">Mot de passe</label>
                <input class="form-control" type="text" name="password" placeholder="Entrez un mot de passe">
            </div>

            <button type="submit" value="submit" class="btn btn-primary mt-3">Créer un compte</button>

            <?php if ($erreur) : ?>
                <div class="alert alert-danger mt-3">
                    <?= $erreur ?>
                </div>
            <?php endif ?>

        </form>

    </div>

</main>

<?php include "pages/footer.php" ?>