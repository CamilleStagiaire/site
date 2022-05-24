<?php
$regionSel = $_POST['region'];

$db = mysqli_connect("localhost", "root", "", "tuto-php", 3306) or die("Erreur de connexion à la base de données");
$result = mysqli_query($db, "SELECT * FROM departement WHERE id_region = $regionSel ORDER BY nom_departement ASC");
$departements = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<label class="form-label" for="">Votre département</label>
<select id="departement" name="departement" class="form-control">
  <?php foreach ($departements as $departement) {
  ?>
    <option value="<?= $departement['id_departement'] ?>"><?= $departement['nom_departement'] ?></option>

  <?php
  }

  ?>
</select>