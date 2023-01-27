<?php
//! Fichiers définissant les accès à la BDD
if (file_exists("./res/php/Utilisateur.php")) {
    include("./res/php/Utilisateur.php");
}
else if (file_exists("../Utilisateur.php")) {
    include("../Utilisateur.php");
}
else {
    include("./Utilisateur.php");
}

define('DB_USERNAME', 'adminHealthyVibe');
define('DB_PASSWORD', 'j@Q#KFc77KYD!ragbDiC9NR');
define('DB_HOST', 'localhost');
define('DB_NAME', 'HealthyVibe');

//! Permet de se connecter au site en vérifiant les informations de connexion fournies mais aussi vérifier si l'utilisateur est banni ou non
function login($mail, $mdp) {
    $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $mail = mysqli_escape_string($co, $mail);
    $mdp = mysqli_escape_string($co, $mdp);
    $result = $co->query("SELECT * FROM utilisateur WHERE email = '$mail' LIMIT 1");  
    if ($result->num_rows > 0) {
        $row = $result->fetch_object ();
        $hash = $row->mdp;
        if (password_verify($mdp, $hash)) {
            if ($row->banni) {
                //! Si l'utilisateur est banni jusu'à une date indéfinie
                if ($row->dateBanFin == NULL || $row->dateBanFin == "5000-10-10") {
                    header ("Location: ./connexion.php?erreur=Banni&reponse=Vous avez été banni de notre site. Si vous pensez que c'est une erreur, veuillez contacter un administrateur.");
                    exit();
                }
                //! Si l'utilisateur est banni jusu'à une date définie, on vérifie si celle si est dépassée
                if ("$row->dateBanFin" <= date("Y-m-d")) {
                    $co->query("UPDATE utilisateur SET banni = 0, dateBanDebut = NULL, dateBanFin = NULL WHERE idUtilisateur = $row->idUtilisateur");

                }
                else {
                    header ("Location: ./connexion.php?erreur=Banni&reponse=Vous êtes banni de notre site du $row->dateBanDebut au $row->dateBanFin. Si vous pensez que c'est une erreur, veuillez contacter un administrateur.");
                    exit();
                }
            }
            //! Si l'utilisateur n'est pas banni, on créer l'utilisateur à partir de la classe Utilisateur
            $_SESSION['utilisateur'] = new Utilisateur($row->idUtilisateur);
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

//! Permet de récupérer une couleur à partir d'un pseudo (utilisée dans le forum)
function getColor($pseudo) {
    $md = md5($pseudo);
    $hex = "#" . substr($md, 0, 6);
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    $color = 'rgb(' . $r . ', ' . $g . ', ' . $b . ', 1)';
    return $color;
}