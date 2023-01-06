<?php

define('DB_USERNAME', 'adminHealthyVibe');
define('DB_PASSWORD', 'adminHealthyVibe');
define('DB_HOST', 'localhost');
define('DB_NAME', 'HealthyVibe');


function login($mail, $mdp) {
    $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $mail = mysqli_escape_string($co, $mail);
    $mdp = mysqli_escape_string($co, $mdp);
    $result = $co->query("SELECT * FROM Utilisateur WHERE email = '$mail' LIMIT 1");  
    if ($result->num_rows > 0) {
        $row = $result->fetch_object ();
        $hash = $row->mdp;
        if (password_verify($mdp, $hash)) {
            if ($row->banni) {
                if ($row->dateBanFin == NULL) {
                    header ("Location: ./connexion.php?erreur=Banni&reponse=Vous avez été banni de notre site. Si vous pensez que c'est une erreur, veuillez contacter un administrateur.");
                    exit();
                }
                if ($row->dateBanFin < date("Y-m-d H:i:s")) {
                    $co->query("UPDATE Utilisateur SET banni = 0 WHERE idUtilisateur = $row->idUtilisateur");
                }
                else {
                    header ("Location: ./connexion.php?erreur=Banni&reponse=Vous êtes banni de notre site du $row->dateBanDebut au $row->dateBanFin. Si vous pensez que c'est une erreur, veuillez contacter un administrateur.");
                    exit();
                }
            }
            $_SESSION['nom'] = $row->nom;
            $_SESSION['prenom'] = $row->prenom;
            $_SESSION['username'] = $row->username;
            $_SESSION['id'] = $row->idUtilisateur;
            $_SESSION['email'] = $row->email;
            $_SESSION['tel'] = $row->tel;
            $_SESSION['adresse'] = $row->adresse;
            $_SESSION['codepostal'] = $row->codepostal;
            $_SESSION['datenaissance'] = $row->datenaissance;
            $_SESSION['role'] = $row->role;
        }
        else {
            header ("Location: ./connexion.php?erreur=Erreur");
            exit();
        }
    } 
    else {
        header ("Location: ./connexion.php?erreur=Erreur");
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