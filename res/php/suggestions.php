<?php 
    //! Permet d'exporter les données d'une table vers AJAX pour la recherche dynamique
    include './fonctions.php';
    session_start();
    $array = array();
    if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur) || empty($_GET["table"]) || !is_numeric($_GET["table"])) {
        header("Location: ../../index.php");
        exit();
    }
    $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($_GET["table"] == 2) {
        $result = $co->query("SELECT * FROM utilisateur");
        while ($row = $result->fetch_object()) {
            if (is_null($row->dateBanDebut)) {
                $row->dateBanDebut = "null";
            }
            if (is_null($row->dateBanFin)) {
                $row->dateBanFin = "null";
            }
            array_push($array, $row->idUtilisateur.';'.$row->nom.';'.$row->prenom.';'.$row->email.';'.$row->username.';'.$row->tel.';'.$row->adresse.';'.$row->codepostal.';'.$row->datenaissance.';null;'.$row->dateBanDebut.';'.$row->dateBanFin.';'.$row->role);
        }
    }
    else if ($_GET["table"] == 1) {
        //! On vérifie qu'il y a au moins 1 post dans la BDD
        $result = $co->query("SELECT * FROM post LIMIT 1");
        if ($result->num_rows > 0) {
            $result = $co->query("SELECT DISTINCT S.idSujet, titre, datecreation, status, (SELECT U.username FROM utilisateur U WHERE U.idUtilisateur = S.idUtilisateur) as username, (SELECT DISTINCT COUNT(*) FROM post WHERE idSujet = S.idSujet) as nbPost FROM sujet S, POST P ORDER BY datecreation DESC;");
            while ($row = $result->fetch_object()) {
                //? Changer format date
                $dateC = date("d-m-Y", strtotime($row->datecreation));
                if ($row->status == 1) {
                    $row->status = "Résolu";
                }
                else {
                    $row->status = "Non résolu";
                }
                array_push($array, $row->idSujet.';'.$row->titre.';'.$dateC.';'.$row->status.';'.$row->nbPost.';null;'.$row->username);
            }
        }
        else {
            $result = $co->query("SELECT DISTINCT S.idSujet, titre, datecreation, status, U.username FROM sujet S NATURAL JOIN utilisateur U ORDER BY datecreation;");
            while ($row = $result->fetch_object()) {
                //? Changer format date
                $dateC = date("d-m-Y", strtotime($row->datecreation));
                if ($row->status == 1) {
                    $row->status = "Résolu";
                }
                else {
                    $row->status = "Non résolu";
                }
                array_push($array, $row->idSujet.';'.$row->titre.';'.$dateC.';'.$row->status.';0;null;'.$row->username);
            }
        }
    }
    
    echo implode('|', $array);
?>