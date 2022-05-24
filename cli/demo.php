<?php

include_once "class".DIRECTORY_SEPARATOR. "User.php";

$pdo = new PDO("mysql:dbname=tuto-php;host=localhost;port=3306", "root", "",
[
PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ,
PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING
]);

$query = $pdo->query("SELECT * FROM user");

$users = $query->fetchAll(PDO::FETCH_CLASS, 'User');







$prepare = $pdo->prepare('SELECT * FROM departement WHERE username = :username');
//$prepare->bindParam("idregion", PDO::PARAM_STMT);

$quote = $pdo->quote($_POST['username']); // doublon avec une requête préparée mais c'est bien pour une query (concaténation dans prépare)

$prepare->execute(
    [
        "username" => $quote
    ]
    );



if ($query === false) {
    die('Erreur dans la requête SQL');
}


$users = $query->fetchAll();

