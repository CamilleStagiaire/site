<?php

session_start();

$db = mysqli_connect("localhost", "root", "", "sdbm", 3306) or die("Erreur de connexion à la base de données");


if (isset($_POST['article'])) {
    $idArticle = (int)$_POST['article'];
    $query = mysqli_prepare($db, "SELECT id_article, nom_article, prix_achat FROM article WHERE id_article = ?");
    
mysqli_stmt_bind_param($query, "i", $idArticle);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);

if ($result) {
    $biere= mysqli_fetch_assoc($result);
    
    if (isset($_SESSION['biere'])) {
         array_push($_SESSION['biere'], $biere);
     }else {
         $_SESSION['biere'] = [];
         array_push($_SESSION['biere'], $biere);
     }

     $information = [];
     $information['biere'] = $biere;
     $information['nbr_article'] = count($_SESSION['biere']);

     echo json_encode($information);
    
} else {
    echo "erreur dans la requête";
}

} else {
    echo "erreur ";
}
