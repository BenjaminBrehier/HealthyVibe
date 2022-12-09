<?php
session_start();
require_once("./fonctions.php");
$idSujet = htmlspecialchars($_GET['idSujet']);
$idPost = htmlspecialchars($_GET['idPost']);

$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$req = $co->query("DELETE FROM POST WHERE idPost = $idPost"); 

header("Location: ../../afficheSujet.php?idSujet=$idSujet");
exit();
