<?php 

include('../fonctions.php');
session_start();
if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur) || !($_SESSION['utilisateur']->getRole())) {
    header("Location: ../../../index.php");
    exit();
} 
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$tips= mysqli_escape_string($co, htmlspecialchars($_POST['tips']));
$lienTips=NULL;
if (!empty($_POST['lienTips'])) {
   $lienTips = mysqli_escape_string($co, htmlspecialchars($_POST['lienTips']));
}


if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 

$req = $co->query("INSERT INTO tipseco(contenu, lienVideo) VALUES('$tips','$lienTips')"); 
header("Location: ../ ../../adminPanel.php?onglet=TipsEcologiques");
exit();
?>
