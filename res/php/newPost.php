<?php
include('./fonctions.php');
session_start();
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$idSujet = mysqli_escape_string($co, htmlspecialchars($_GET['idSujet']));
$contenu = mysqli_escape_string($co, htmlspecialchars($_POST['contenu']));
$idPostReponse = mysqli_escape_string($co, htmlspecialchars($_POST['idPost']));

$idUtilisateur = $_SESSION['utilisateur']->getId();

$date = date('Y-m-d H:i:s');
$req = $co->query("INSERT INTO POST(date, contenu, idUtilisateur, idSujet, idReponse) VALUES('$date','$contenu', $idUtilisateur, $idSujet, $idPostReponse)"); 

header("Location: ../../afficheSujet.php?idSujet=$idSujet#form");
exit();