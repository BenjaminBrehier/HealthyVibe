<?php
include './fonctions.php';
session_start();
$idSujet = htmlspecialchars($_GET['idSujet']);
$idUtilisateur = htmlspecialchars($_GET['idUtilisateur']);
$from = htmlspecialchars($_GET['from']);

if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (($idUtilisateur == $_SESSION['utilisateur']->getId()) || $_SESSION['utilisateur']->getRole()) {
    $req = $co->query("UPDATE SUJET SET status = 1 WHERE idSujet = $idSujet"); 
}
if ($from == 1) {
    header("Location: ../../forum.php");
    exit();
} else {
    header("Location: ../../adminPanel.php?onglet=Forum");
    exit();
}