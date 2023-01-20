<?php
include './fonctions.php';
session_start();
$idSujet = htmlspecialchars($_GET['idSujet']);
$idPost = htmlspecialchars($_GET['idPost']);
$idUtilisateur = htmlspecialchars($_GET['idUtilisateur']);

if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 
if ($_SESSION['utilisateur']->getId() == $idUtilisateur || $_SESSION['utilisateur']->getRole()) {
    $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $req = $co->query("DELETE FROM POST WHERE idPost = $idPost"); 
}

header("Location: ../../afficheSujet.php?idSujet=$idSujet");
exit();
