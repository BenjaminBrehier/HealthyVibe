<?php
//! Permet de cloturer (fermer) un sujet du forum
include './fonctions.php';
session_start();
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$idSujet = mysqli_escape_string($co, htmlspecialchars($_GET['idSujet']));
$from = htmlspecialchars($_GET['from']);

if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 

//? On récupère l'id de l'utilisateur qui a créé le sujet
$result = $co->query("SELECT idUtilisateur FROM sujet WHERE idSujet = $idSujet");
$row = $result->fetch_object();
$idUtilisateur = $row->idUtilisateur;
if (($idUtilisateur == $_SESSION['utilisateur']->getId()) || $_SESSION['utilisateur']->getRole()) {
    $req = $co->query("UPDATE sujet SET status = 1 WHERE idSujet = $idSujet"); 
}
if ($from == 1) {
    header("Location: ../../forum.php");
    exit();
} else {
    header("Location: ../../adminPanel.php?onglet=Forum");
    exit();
}