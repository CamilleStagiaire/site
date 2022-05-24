<?php
session_start();
$pdo = new PDO(
    "mysql:dbname=tuto-php;host=localhost;port=3306",
    "root",
    "",
    [
        PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
    ]
);
$error = null;
$success = null;
try {
    if (isset($_POST['name'], $_POST['content'])) {
        $query = $pdo->prepare('UPDATE posts SET name = :name, content = :content WHERE id = :id');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'id' => $_GET['id']
        ]);
        $success = 'Votre article a bien été modifié';
    }
    $query = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
    $query->execute([
        'id' => $_GET['id']
    ]);
    $post = $query->fetch(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    $error = $e->getMessage();
}


$titre = "blog";
include "pages/header.php";
?>

<p><a href="./blog">Revenir au listing</a></p>
<?php if ($success) : ?>
    <div class="alert alert-success text-center col-md-6 offset-3 mt-3"><?= $success ?></div>
<?php endif ?>
<?php if ($error) : ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php else : ?>
    <main class="container mt-3 text-center col-md-6 offset-3">
        <h1 class="mt-5">Modifier l'article</h1>

        <form action="" method="post" class="mt-3">
            <div class="md-3">
                <label class="form-label">Titre de l'article</label>
                <input class="form-control" type="text" name="name" value="<?= htmlentities($post->name) ?>">

            </div>
            <div class="md-3">
                <label class="form-label">Contenu de l'article</label>
                <textarea class="form-control" name="content" rows="10"><?= htmlentities($post->content) ?></textarea>

            </div>

            <button class="btn btn-primary mt-3">Sauvegarder</button>
        </form>


    <?php endif ?>

    </main>

    <?php include "pages/footer.php" ?>