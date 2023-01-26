<?php
//! Permet de bannir un utilisateur jusqu'a une certaine date ou indefiniment
include './fonctions.php';
session_start();

if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($_SESSION['utilisateur']->getRole()) {
    $idUtilisateur = mysqli_escape_string($co, htmlspecialchars($_GET['idUtilisateur']));
    if (isset($_GET['dateFin'])) {
        $dateFin = mysqli_escape_string($co, htmlspecialchars($_GET['dateFin']));
        $now = date("Y-m-d");
        $req = $co->query("UPDATE utilisateur SET banni = 1, dateBanFin = '$dateFin', dateBanDebut = '$now' WHERE idUtilisateur = $idUtilisateur");
        header("Location: ../../adminPanel.php?onglet=Utilisateurs");
        exit();
    }
    else {
        $now = date("Y-m-d");
        $req = $co->query("UPDATE utilisateur SET banni = 1, dateBanFin = '5000-10-10', dateBanDebut = '$now' WHERE idUtilisateur = $idUtilisateur"); 
        header("Location: ../../adminPanel.php?onglet=Utilisateurs");
        exit();
    }
}

header("Location: ../../index.php");
exit();
