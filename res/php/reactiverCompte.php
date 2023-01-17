<?php
include("./fonctions.php");
session_start();
$idUtilisateur = htmlspecialchars($_GET['idUtilisateur']);

$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($_SESSION['utilisateur']->getRole()) {
    $req = $co->query("UPDATE Utilisateur SET banni = 0, dateBanDebut = NULL, dateBanFin = NULL WHERE idUtilisateur = $idUtilisateur"); 
    header("Location: ../../adminPanel.php?onglet=Utilisateurs");
    exit();
}

header("Location: ../../index.php");
exit();
