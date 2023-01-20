<?php 
    include './fonctions.php';
    session_start();
    $array = array();
    if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur) || empty($_GET["table"]) || !is_numeric($_GET["table"])) {
        header("Location: ../../index.php");
        exit();
    }
    $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($_GET["table"] == 0) {
        
    }
    else if ($_GET["table"] == 1) {
        //! On vérifie qu'il y a au moins 1 post dans la BDD
        $result = $co->query("SELECT * FROM POST LIMIT 1");
        if ($result->num_rows > 0) {
            $result = $co->query("SELECT DISTINCT S.idSujet, titre, datecreation, status, (SELECT U.username FROM UTILISATEUR U WHERE U.idUtilisateur = S.idUtilisateur) as username, (SELECT DISTINCT COUNT(*) FROM POST WHERE idSujet = S.idSujet) as nbPost FROM `SUJET` S, POST P ORDER BY datecreation DESC;");
            while ($row = $result->fetch_object()) {
                //? Changer format date
                $date = date("d-m-Y", strtotime($row->datecreation));
                array_push($array, $row->idSujet.';'.$row->username.';'.$row->titre.';'.$date.';'.$row->nbPost);
            }
        }
        else {
            $result = $co->query("SELECT DISTINCT S.idSujet, titre, datecreation, status, U.username FROM `SUJET` S NATURAL JOIN UTILISATEUR U ORDER BY datecreation;");
            while ($row = $result->fetch_object()) {
                //? Changer format date
                $date = date("d-m-Y", strtotime($row->datecreation));
                array_push($array, $row->idSujet.';'.$row->username.';'.$row->titre.';'.$date);
            }
        }
    }
    
    echo implode('|', $array);
?>