<?php

define('DB_USERNAME', 'HealthyVibeAdmin');
define('DB_PASSWORD', 'HealthyVibeAdmin');
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
    } else {
        header ("Location: ./connexion.php?reponse=Erreur");
        exit();
    }
}