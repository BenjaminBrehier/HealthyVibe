<?php
session_start();
require_once("./fonctions.php");
$idSujet = htmlspecialchars($_GET['idSujet']);
$idUtilisateur = htmlspecialchars($_GET['idUtilisateur']);

$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (($idUtilisateur == $_SESSION['id']) || $_SESSION['role']) {
    $req = $co->query("UPDATE SUJET SET status = 1 WHERE idSujet = $idSujet"); 
}

header("Location: ../../afficheSujet.php?idSujet=$idSujet");
exit();