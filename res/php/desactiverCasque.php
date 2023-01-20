<?php 
include './fonctions.php';
session_start();

if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 

$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($_SESSION['utilisateur']->getRole()) {
    $idCasque = htmlspecialchars($_GET['idCasque']);
    $val = htmlspecialchars($_GET['actif']);
    $req = $co->query("UPDATE Casque SET actif = $val WHERE idCasque = $idCasque");
    header("Location: ../../adminPanel.php?onglet=Casques");
    exit();
}

?>