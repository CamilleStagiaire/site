<?php
session_start();
$titre = "forum";

$db = mysqli_connect("localhost", "root", "", "tuto-php", 3306) or die("Erreur de connexion à la base de données");
$result = mysqli_query($db, "SELECT * FROM region");
$regions = mysqli_fetch_all($result, MYSQLI_ASSOC);

include "pages/header.php";
?>

<main class=" container mt-3 ms-6">
  <h1 class="text-center">Forum</h1>
  
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
 
</main>

<?php include "pages/footer.php" ?>