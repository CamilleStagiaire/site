<?php

//NAVBAR
function navItem(string $lien, string $titre, string $className): string
{
    if ($_SERVER['SCRIPT_NAME'] == $lien) {
        $className = $className . ' active';
    }
    return <<<HTML
  <li class='nav-item'>
      <a class="$className" href="$lien">$titre</a></li>
  HTML;
}

function navMenu(string $className): string
{
    return navItem('/codePhp/php/index.php', 'Accueil', $className) .
        navItem('/codePhp/php/horaires.php', 'Horaires', $className) .
        navItem('/codePhp/php/menu.php', 'Menu', $className) .
        navItem('/codePhp/php/composerGlace.php', 'Glaces', $className) .
        navItem('/codePhp/php/connexion.php', 'Connexion', $className) .
        navItem('/codePhp/php/newsletter.php', 'Newsletter', $className) ;        
}

//AFFICHAGE DES HORAIRES CORRIGE
define("HORAIRES", [
    [
        [8, 12],
        [14, 17]
    ],
    [
        [8, 12],
        [14, 18]
    ],
    [
        [10, 12],
        [14, 19]
    ],
    [
        [9, 12],
        [13, 19]
    ],
    [
        [8, 12],
        [14, 18]
    ],
    [
        [8, 12],
    ],
    [] // pour le dimanche
]);

define('JOURS', [
    "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche"
]);

function creneau_phrase(array $horaires = HORAIRES): string
{
    if (empty($horaires)) {
        return "fermé";
    }

    $html = [];
    foreach ($horaires as $heure) {
        $html[] = "de {$heure[0]}h à {$heure[1]}h"; // interporler quand on enlève les espaces
    }
    return implode(' et ', $html); // fonction pour transformer un tableau en string
}

function afficherHoraire(string $className = "")
{
    $phrase = "<ul class=$className>";
    foreach (JOURS as $key => $value) {
        if (($key + 1) === (int)date('N')) {
            $phrase .= "<li style=\"color:blue\"><strong> $value : </strong>" . creneau_phrase(HORAIRES[$key]) . "</li>";
        } else {

            $phrase .= "<li><strong> $value : </strong>" . creneau_phrase(HORAIRES[$key]) . "</li>";
        }
    }
    $phrase .= "</ul>";
    return $phrase;
}

//AFFICHAGE OUVERT/FERME CORRECTION
function ouvertureFermeture()
{

    $jour = (int)date("N") - 1;
    $heure = (int)date("H");
    $creneaux = HORAIRES[$jour];

    foreach ($creneaux as $creneau) {
        $debut = $creneau[0];
        $fin = $creneau[1];

        if ($heure >= $debut && $heure < $fin) {
            return true;
        }
    }
    return false;
}


//PAGE COMPOSER GLACES
function checkbox(string $name, string $value, array $data) : string
{
    $attributes = '';

    if (isset($data[$name]) && in_array($value, $data[$name])) {
        $attributes.= 'checked';
    }
    return <<<HTML
    <input class= "form-check-input" type= "checkbox" value="$value" name ="{$name}[]" $attributes>
    HTML;
}

function radio(string $name, string $value, array $data) : string
{
    $attributes = '';

    if (isset($data[$name]) && $value === $data[$name]) {
        $attributes.= 'checked';
    }
    return <<<HTML
    <input class= "form-check-input" type= "radio" value="$value" name ="$name" $attributes>
    HTML;
}


function verifUser($db, string $user) : bool
{
    $query = mysqli_prepare($db, "SELECT password FROM user WHERE username = ?");
    mysqli_stmt_bind_param($query, "s", $user);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    $user = mysqli_fetch_assoc($result);
   
    if($user === null){
       return false;
   }
   return true;
}



