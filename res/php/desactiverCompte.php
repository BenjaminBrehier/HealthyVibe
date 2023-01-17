<?php
include './fonctions.php';
session_start();

$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($_SESSION['utilisateur']->getRole()) {
    $idUtilisateur = htmlspecialchars($_GET['idUtilisateur']);
    if (isset($_GET['dateFin'])) {
        $dateFin = htmlspecialchars($_GET['dateFin']);
        $now = date("Y-m-d");
        $req = $co->query("UPDATE Utilisateur SET banni = 1, dateBanFin = '$dateFin', dateBanDebut = '$now' WHERE idUtilisateur = $idUtilisateur");
        header("Location: ../../adminPanel.php?onglet=Utilisateurs");
        exit();
    }
    else {
        $req = $co->query("UPDATE Utilisateur SET banni = 1 WHERE idUtilisateur = $idUtilisateur"); 
        header("Location: ../../adminPanel.php?onglet=Utilisateurs");
        exit();
    }
}

header("Location: ../../index.php");
exit();
