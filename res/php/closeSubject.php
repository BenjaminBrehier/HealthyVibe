<?php
session_start();
require_once("./fonctions.php");
$idSujet = htmlspecialchars($_GET['idSujet']);
$idUtilisateur = htmlspecialchars($_GET['idUtilisateur']);
$from = htmlspecialchars($_GET['from']);

$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (($idUtilisateur == $_SESSION['id']) || $_SESSION['role']) {
    $req = $co->query("UPDATE SUJET SET status = 1 WHERE idSujet = $idSujet"); 
}
if ($from == 1) {
    header("Location: ../../forum.php");
    exit();
} else {
    header("Location: ../../adminPanel.php?onglet=Forum");
    exit();
}