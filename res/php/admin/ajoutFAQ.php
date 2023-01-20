<?php 

include('../fonctions.php');
session_start();
if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur) || !($_SESSION['utilisateur']->getRole())) {
    header("Location: ../../../index.php");
    exit();
} 
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$question= mysqli_escape_string($co, htmlspecialchars($_POST['question']));
$reponse = mysqli_escape_string($co, htmlspecialchars($_POST['reponse']));



if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 

$req = $co->query("INSERT INTO FAQ(question,reponse) VALUES('$question','$reponse')"); 
header("Location: ../../adminPanel.php?onglet=FAQ");
exit();
?>