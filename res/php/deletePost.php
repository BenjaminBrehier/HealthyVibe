<?php
//! Permet de supprimer un post d'un sujet
include './fonctions.php';
session_start();
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$idSujet = htmlspecialchars($_GET['idSujet']);
$idPost = mysqli_escape_string($co, htmlspecialchars($_GET['idPost']));
$idUtilisateur = htmlspecialchars($_GET['idUtilisateur']);

if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 
if ($_SESSION['utilisateur']->getId() == $idUtilisateur || $_SESSION['utilisateur']->getRole()) {
    $req = $co->query("DELETE FROM post WHERE idPost = $idPost"); 
}

header("Location: ../../afficheSujet.php?idSujet=$idSujet");
exit();
