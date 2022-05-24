<?php
session_start();
$titre = "boutique";

$db = mysqli_connect("localhost", "root", "", "tuto-php", 3306) or die("Erreur de connexion à la base de données");
$db2 = mysqli_connect("localhost", "root", "", "sdbm", 3306) or die("Erreur de connexion à la base de données");

$result = mysqli_query($db, "SELECT * FROM region ORDER BY nom_region ASC");


if ($result) {
  $regions = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
  die("Erreur dans la requête SQL");
}

$query2 = mysqli_query($db2, "SELECT * FROM article LIMIT 10");
if ($query2) {
  $bieres = mysqli_fetch_all($query2, MYSQLI_ASSOC);
} else {
  die("Erreur dans la requête SQL");
}

include "pages/header.php";
?>

<main class=" container mt-3 ms-6">
  <h1 class="text-center">Rechercher une ville</h1>

  <form action="forum.php" method="POST" id="form" class="row">

    <div class="col md-4">
      <div class="form-group">
        <label class="form-label" for="">Votre région</label>
        <select id="region" name="id_region" class="form-control">
          <option selected>Choisissez la région :</option>
          <?php
          foreach ($regions as $region) {
          ?>
            <option value="<?= $region['id_region'] ?>"><?= $region['nom_region'] ?></option>
          <?php
          }

          ?>
        </select>
      </div>
    </div>

    <div class="col-md-4" id="depSelect"></div>
    <div class="col-md-4" id="result"></div>
  </form>

  <hr>
  <h1 class="text-center">Boutique en ligne</h1>

  <div class="row">
    <div class="col md-2">
      <a class="btn btn-primary position-relative" href="panier.php">
        Panier
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="nbrArticle">
          <?= empty($_SESSION['biere']) ? "0" : count($_SESSION['biere']) ?>
        </span>
        </a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 offset-3">
      <div id="alert"></div>
    </div>
  </div>

  <div class="row mt-3">
    <?php foreach ($bieres as $biere) : ?>
      <div class="card me-3 mt-3" style="width: 12rem;">
        <div class="card-body">
          <h5 class="card-title"><?= $biere['NOM_ARTICLE'] ?></h5>
          <h6 class="card-subtitle mb-2 text-muted"><?= number_format($biere['PRIX_ACHAT'], 2) ?> €</h6>
          <a href="" class="btn btn-success position-absolute bottom-0 end-0 panier" data-id=<?= $biere['ID_ARTICLE'] ?>>Ajouter</a>

        </div>
      </div>
    <?php endforeach ?>
  </div>

  </div>

</main>

<?php include "pages/footer.php" ?>