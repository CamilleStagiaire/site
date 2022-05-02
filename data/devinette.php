<?php

$aDeviner = 50;

$nombre = $_POST['nombre'];

if ($nombre < $aDeviner) {
echo "<div class='alert alert-danger mt-3'> Trop petit </div>";
} else if ($nombre > $aDeviner) {
    echo "<div class='alert alert-danger mt-3'> Trop grand </div>"; 
} else {
    echo "<div class='alert alert-success mt-3'> Bravo vous avez trouvé ! </div>"; 
}

