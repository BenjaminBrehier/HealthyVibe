<?php 

include('../fonctions.php');
session_start();
if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur) || !($_SESSION['utilisateur']->getRole())) {
    header("Location: ../../../index.php");
    exit();
} 
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$lieu= mysqli_escape_string($co, htmlspecialchars($_POST['lieu']));


if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 

$req = $co->query("INSERT INTO lieuvente(lieu) VALUES('$lieu')"); 
header("Location: ../../adminPanel.php?onglet=Lieux");
exit();
?>