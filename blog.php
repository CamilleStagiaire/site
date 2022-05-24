<?php
session_start();
require_once 'class/Post.php';
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
try {
    if (isset($_POST['name'], $_POST['content'])) {
        $query = $pdo->prepare('INSERT INTO posts (name, content, created_at) VALUES (:name, :content, :created)');
        
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'created' => time()
        ]);
        header('Location: ./edit.php?id=' . $pdo->lastInsertId()); // retourne le dernier id enregistré
        exit();
        
    }
    $query = $pdo->query('SELECT * FROM posts');
    $posts = $query->fetchAll(PDO::FETCH_CLASS, 'Post');

} catch (PDOException $e) {
    $error = $e->getMessage();
}

$titre = "blog";
include "pages/header.php";
?>
<?php if ($error) : ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php else : ?>
    <main class="container mt-3">

    <h1 class="text-center mt-5">Blog</h1>
        
            <?php foreach ($posts as $post) : ?>
            
                <h3><a style="text-decoration: none;" href="./edit.php?id=<?=$post->id ?>"><?= htmlentities($post->name)?></a></h3>
               <p class="small text-muted">Ecrit le <?= $post->created_at->format('d/m/Y')?> </p>
                <p>
                <?= nl2br(htmlentities($post->getExcerpt()))?>
                </p>
            <?php endforeach ?>
        
        <h2 class="text-center mt-5">Ajouter un nouvel article</h2>
        <form action="" method="post" class="mt-3">
            <div class="md-3">
                <label class="form-label">Titre de l'article</label>
                <input class="form-control" type="text" name="name" placeholder="Titre" value="">

            </div>
            <div class="md-3">
                <label class="form-label">Contenu de l'article</label>
                <textarea class="form-control" name="content" placeholder="Contenu" rows="10"></textarea>

            </div>

            <button class="btn btn-primary mt-3">Sauvegarder</button>
        </form>

    <?php endif ?>

    </main>

    <?php include "pages/footer.php" ?>