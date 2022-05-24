<?php 
session_start();
session_unset();
header('location: boutique.php');
?>