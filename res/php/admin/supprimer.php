<?php 

include('../fonctions.php');
session_start();

$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$id=mysqli_escape_string($co, htmlspecialchars($_GET['idT']));
$table= mysqli_escape_string($co, htmlspecialchars($_GET['table']));

if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur) || !($_SESSION['utilisateur']->getRole())) {
    header("Location: ../../../index.php");
    exit();
} 

if ($table=='tipsEco'){
    $req = $co->query("DELETE FROM $table WHERE idTips=$id"); 
    header("Location: ../../../adminPanel.php?onglet=TipsEcologiques");
}

else if ($table=='FAQ'){
    $req = $co->query("DELETE FROM $table WHERE idFaq=$id"); 
    header("Location: ../../../adminPanel.php?onglet=FAQ");
}

else if ($table=='lieuvente'){
    $req = $co->query("DELETE FROM $table WHERE idLieu=$id"); 
    header("Location: ../../../adminPanel.php?onglet=lieuvente");
}



exit();
?>
