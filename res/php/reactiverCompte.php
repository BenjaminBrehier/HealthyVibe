<?php
//! Permet de réactiver un compte suspendu
include("./fonctions.php");
session_start();
if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$idUtilisateur = mysqli_escape_string($co, htmlspecialchars($_GET['idUtilisateur']));

if ($_SESSION['utilisateur']->getRole()) {
    $req = $co->query("UPDATE utilisateur SET banni = 0, dateBanDebut = NULL, dateBanFin = NULL WHERE idUtilisateur = $idUtilisateur"); 
    header("Location: ../../adminPanel.php?onglet=Utilisateurs");
    exit();
}

header("Location: ../../index.php");
exit();
