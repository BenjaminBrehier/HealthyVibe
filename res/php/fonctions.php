<?php

define('DB_USERNAME', 'HealthyVibeAdmin');
define('DB_PASSWORD', 'HealthyVibeAdmin');
define('DB_HOST', 'localhost');
define('DB_NAME', 'HealthyVibe');


function login($mail, $mdp) {
    $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $result = $co->query("SELECT * FROM Utilisateur WHERE email = '$mail' AND mdp = '$mdp'");
    if (!$result) {
        header("Location: ./connexion.php?reponse=Erreur");
        exit();
    } else {
        $row = $result->fetch_object();
        $_SESSION['nom'] = $row->nom;
        $_SESSION['prenom'] = $row->prenom;
        $_SESSION['id'] = $row->idUtilisateur;
    }
}