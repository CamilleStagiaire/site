<?php
$depSel = $_POST['dep'];

$db = mysqli_connect("localhost", "root", "", "tuto-php", 3306) or die("Erreur de connexion à la base de données");
$result = mysqli_query($db, "SELECT * FROM ville WHERE id_departement = $depSel");
$villes = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<label class="form-label" for="">Votre ville</label>
<select id="ville" name="ville" class="form-control">
    <?php foreach ($villes as $ville) {
    ?>
        <option value="<?= $ville['id_ville'] ?>"><?= $ville['nom_ville'] ?></option>

    <?php
    }

    ?>
</select>