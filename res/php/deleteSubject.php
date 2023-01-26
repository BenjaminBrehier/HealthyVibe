<?php
//! Permet de supprimer un sujet
include './fonctions.php';
session_start();
$idSujet = mysqli_escape_string($co, htmlspecialchars($_GET['idSujet']));
$from = htmlspecialchars($_GET['from']);

if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($_SESSION['utilisateur']->getRole()) {
    $req = $co->query("DELETE FROM sujet WHERE idSujet = $idSujet"); 
}
if ($from == 1) {
    header("Location: ../../forum.php");
    exit();
} else {
    header("Location: ../../adminPanel.php?onglet=Forum");
    exit();
}

