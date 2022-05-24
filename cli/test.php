<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Creneau.php';
$creneau = new Creneau(9, 12);
var_dump($creneau->inclusHeure(10));


echo $creneau->toHTML();