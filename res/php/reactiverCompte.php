<?php
session_start();
require_once("./fonctions.php");
$idUtilisateur = htmlspecialchars($_GET['idUtilisateur']);

$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($_SESSION['role']) {
    $req = $co->query("UPDATE Utilisateur SET banni = 0, dateBanDebut = NULL, dateBanFin = NULL WHERE idUtilisateur = $idUtilisateur"); 
    header("Location: ../../adminPanel.php");
    exit();
}

header("Location: ../../index.php");
exit();
