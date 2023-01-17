<?php
include './fonctions.php';
session_start();
$idSujet = htmlspecialchars($_GET['idSujet']);
$idPost = htmlspecialchars($_GET['idPost']);

// if (!isset($_SESSION['utilisateur'])) {
//     header("Location: ../../connexion.php?reponse=Erreur");
//     exit();
// }
// if ($_SESSION['utilisateur']->)
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$req = $co->query("DELETE FROM POST WHERE idPost = $idPost"); 

header("Location: ../../afficheSujet.php?idSujet=$idSujet");
exit();
