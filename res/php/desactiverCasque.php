<?php 
//! Permet de désactiver un casque
include './fonctions.php';
session_start();

if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 

$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($_SESSION['utilisateur']->getRole()) {
    $idCasque = mysqli_escape_string($co, htmlspecialchars($_GET['idCasque']));
    $val = mysqli_escape_string($co, htmlspecialchars($_GET['actif']));
    if ($val == 1) {
        $req = $co->query("UPDATE casque SET actif = $val, idUtilisateur = ancienID WHERE idCasque = $idCasque");
        file_get_contents("http://projets-tomcat.isep.fr:8080/appService/?ACTION=COMMAND&TEAM=G02A&TRAME=1G02A13071111ON");
    } else {
        $req = $co->query("UPDATE casque SET actif = $val, ancienID = idUtilisateur, idUtilisateur = Null WHERE idCasque = $idCasque");
        file_get_contents("http://projets-tomcat.isep.fr:8080/appService/?ACTION=COMMAND&TEAM=G02A&TRAME=1G02A13071111OF");
    }
    header("Location: ../../adminPanel.php?onglet=Casques");
    exit();
}

?>