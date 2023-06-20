<?php
//! Récupère les données du casque de l'utilisateur pour les envoyer au graphique (via AJAX)
include './fonctions.php';
session_start();
if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur) || empty($_GET["dateDebut"]) || empty($_GET["dateFin"])) {
    header("Location: ../../index.php");
    exit();
}
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$dateDebut = mysqli_escape_string($co, htmlspecialchars($_GET["dateDebut"]));
$dateFin = mysqli_escape_string($co, htmlspecialchars($_GET["dateFin"]));
$from = mysqli_escape_string($co, htmlspecialchars($_GET["from"]));
$array = array();
if ($from == "espaceSantee") {
    $result = $co->query("SELECT * FROM donnee INNER JOIN capteur ON donnee.idCapteur = capteur.idCapteur INNER JOIN casque ON capteur.idCasque = casque.idCasque WHERE (capteur.type = 'temperature corporelle' OR capteur.type = 'pouls' OR capteur.type = 'decibel') AND casque.idUtilisateur = ".$_SESSION['utilisateur']->getId()." AND donnee.date BETWEEN '$dateDebut' AND '$dateFin' ORDER BY date");
}
else {
    $result = $co->query("SELECT * FROM donnee INNER JOIN capteur ON donnee.idCapteur = capteur.idCapteur INNER JOIN casque ON capteur.idCasque = casque.idCasque WHERE (capteur.type = 'temperature extérieure' OR capteur.type = 'gaz' OR capteur.type = 'humidite' OR capteur.type = 'tvoc') AND casque.idUtilisateur = ".$_SESSION['utilisateur']->getId()." AND donnee.date BETWEEN '$dateDebut' AND '$dateFin' ORDER BY date");
}
$pouls = array();
$temperatureCorp = array();
$decibel = array();
$gaz = array();
$temperatureExt = array();
$decibelExt = array();
$tvoc = array();
//! On parcours les données (valeur et date associées) pour les mettre dans le tableau correspondant
while ($row = $result->fetch_object()) {
    $row->date = date("d-m-Y H:i:s", strtotime($row->date));
    $row->valeur = $row->valeur.'&'.$row->date;
    if ($row->type == "pouls") {
        array_push($pouls, $row->valeur);
    }
    else if ($row->type == "temperature corporelle") {
        array_push($temperatureCorp, $row->valeur);
    }
    else if ($row->type == "decibel") {
        array_push($decibel, $row->valeur);
    }
    else if ($row->type == "gaz") {
        array_push($gaz, $row->valeur);
    }
    else if ($row->type == "tvoc") {
        array_push($tvoc, $row->valeur);
    }
    else if ($row->type == "temperature extérieure") {
        array_push($temperatureExt, $row->valeur);
    }
    else if ($row->type == "humidite") {
        array_push($decibelExt, $row->valeur);
    }
}

$co->close();
if (count($pouls) > 0) {
    array_push($array, implode(';',$pouls));
}
else {
    array_push($array, "0");
}

if (count($temperatureCorp) > 0) {
    array_push($array, implode(';',$temperatureCorp));
}
else {
    array_push($array, "0");
}

if (count($decibel) > 0) {
    array_push($array, implode(';',$decibel));
}
else {
    array_push($array, "0");
}

if (count($temperatureExt) > 0) {
    array_push($array, implode(';',$temperatureExt));
}
else {
    array_push($array, "0");
}

if (count($gaz) > 0) {
    array_push($array, implode(';',$gaz));
}
else {
    array_push($array, "0");
}


if (count($decibelExt) > 0) {
    array_push($array, implode(';',$decibelExt));
}
else {
    array_push($array, "0");
}

if (count($tvoc) > 0) {
    array_push($array, implode(';',$tvoc));
}
else {
    array_push($array, "0");
}

echo implode('|', $array);
?>