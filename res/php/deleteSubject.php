<?php
session_start();
require_once("./fonctions.php");
$idSujet = htmlspecialchars($_GET['idSujet']);

$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($_SESSION['role']) {
    $req = $co->query("DELETE FROM SUJET WHERE idSujet = $idSujet"); 
}

header("Location: ../../forum.php");
exit();
