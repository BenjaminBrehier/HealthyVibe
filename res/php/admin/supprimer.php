<?php 

include('../fonctions.php');
session_start();

$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$idT=mysqli_escape_string($co, htmlspecialchars($_GET['idT']));
$table= mysqli_escape_string($co, htmlspecialchars($_GET['table']));

// if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
//     header("Location: ./index.php");
//     exit();
// } 

if ($table=='tipsEco'){
    $req = $co->query("DELETE FROM $table WHERE idTips=$idT"); 
    header("Location: ../../../adminPanel.php?onglet=TipsEcologiques");
}

else if ($table=='FAQ'){
    $req = $co->query("DELETE FROM $table WHERE idFAQ=$idT"); 
    header("Location: ../../../adminPanel.php?onglet=FAQ");
}



exit();
?>
