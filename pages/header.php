<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . "fonctions" . DIRECTORY_SEPARATOR . "fonctions.php";
?><!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="assets/terre.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="assets/app.js" defer></script>
  <script src="assets/ajax.js" defer></script>
  <script src="assets/panier.js" defer></script>
  
  <style>
    .list-group {
      list-style-type: none;
    }
  </style>
  <title><?= $titre ?? "test PHP" ?></title>
</head>

<body>
  <nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-fluid">
      <img src="assets/terre.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
      <a class="navbar-brand" href="#">Tests</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <?= navMenu('nav-link') ?>
        </ul>
        <?php if (!empty($_SESSION['biere'])) : ?>
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="panier.php">Panier</a></li>
        </ul>
        <?php endif ?>
      </div>
    </div>
  </nav>
