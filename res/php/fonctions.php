<?php

define('DB_USERNAME', 'adminHealthyVibe');
define('DB_PASSWORD', 'adminHealthyVibe');
define('DB_HOST', 'localhost');
define('DB_NAME', 'HealthyVibe');


function login($mail, $mdp) {
    $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $mail = mysqli_escape_string($co, $mail);
    $mdp = mysqli_escape_string($co, $mdp);
    $result = $co->query("SELECT * FROM Utilisateur WHERE email = '$mail' AND mdp = '$mdp' LIMIT 1");  
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_object ();
        $_SESSION['nom'] = $row->nom;
        $_SESSION['prenom'] = $row->prenom;
        $_SESSION['id'] = $row->idUtilisateur;
        $_SESSION['email'] = $row->email;
        $_SESSION['tel'] = $row->tel;
        $_SESSION['adresse'] = $row->adresse;
        $_SESSION['codepostal'] = $row->codepostal;
        $_SESSION['datenaissance'] = $row->datenaissance;
        $_SESSION['role'] = $row->role;

    } else {
        header ("Location: ./connexion.php?reponse=Erreur");
        exit();
    }
}

function getColor($pseudo) {
    $md = md5($pseudo);
    $hex = "#" . substr($md, 0, 6);
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    $color = 'rgb(' . $r . ', ' . $g . ', ' . $b . ', 1)';
    return $color;
}