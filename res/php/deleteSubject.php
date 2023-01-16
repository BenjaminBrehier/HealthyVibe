<?php
session_start();
require_once("./fonctions.php");
$idSujet = htmlspecialchars($_GET['idSujet']);
$from = htmlspecialchars($_GET['from']);

$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($_SESSION['role']) {
    $req = $co->query("DELETE FROM SUJET WHERE idSujet = $idSujet"); 
}
if ($from == 1) {
    header("Location: ../../forum.php");
    exit();
} else {
    header("Location: ../../adminPanel.php?onglet=Forum");
    exit();
}

