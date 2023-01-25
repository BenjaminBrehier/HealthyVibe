<?php
include './res/php/fonctions.php';
session_start();
//! Vérfication que l'user est connecté
if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 
$sujets = array();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="./res/css/forum.css">
    <script src="res/js/script.js"></script>
</head>

<body>
    <?php
        include './res/php/header.php';
    ?>

    <section>
        <div class="liens">
            <a href="./index.php">Accueil </a>
            <p>></p>
            <a href="./forum.php">Forum</a>
        </div>
        <div class="container">
            <div id="left">
                <input type="text" oninput="getSuggestions(1)" id="search" placeholder="Rechercher un sujet">
                <div id="contenu">
                    <?php
                    $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                    //! On vérifie qu'il y a au moins 1 post dans la BDD
                    $result = $co->query("SELECT * FROM POST LIMIT 1");
                    if ($result->num_rows > 0) {
                        //! Requete récupérant chaque sujets du forum ainsi que le nombre de posts de celui-ci et son auteur (pour l'instant son nom)
                        $result = $co->query("SELECT DISTINCT S.idSujet, titre, datecreation, datemodification, status, (SELECT U.username FROM UTILISATEUR U WHERE U.idUtilisateur = S.idUtilisateur) as username, (SELECT DISTINCT COUNT(*) FROM POST WHERE idSujet = S.idSujet) as nbPost FROM `SUJET` S, POST P ORDER BY datecreation DESC;"); 
                        while ($row = $result->fetch_object()) {
                            if($row->status) {
                                $titre = $row->titre . " [Résolu]";
                            } else {
                                $titre = $row->titre;
                            }
                            $sujets[$titre.'|||'.$row->idSujet] = $row->nbPost; 
                            $date = date("d-m-Y", strtotime($row->datecreation));  
                            ?>
                            <div class="topic" onclick="afficher(<?php echo $row->idSujet; ?>)">
                                <h2><?php echo $titre;?></h2>
                                <p>Créé par <?php echo $row->username;?> le <?php echo $date; ?> - <?php echo $row->nbPost; ?> posts</p>
                            </div>
                            <?php
                        }
                    }
                    else {
                        //! Requete récupérant chaque sujets du forum et l'auteur
                        $result = $co->query("SELECT DISTINCT S.idSujet, titre, datecreation, datemodification, status, U.username FROM `SUJET` S NATURAL JOIN UTILISATEUR U ORDER BY datecreation;"); 
                        while ($row = $result->fetch_object()) {
                            if($row->status) {
                                $titre = $row->titre . " [Résolu]";
                            } else {
                                $titre = $row->titre;
                            }
                            $sujets[$titre.'|||'.$row->idSujet] = 0; 
                            $date = date("d-m-Y", strtotime($row->datecreation));  
                            ?>
                            <div class="topic" onclick="afficher(<?php echo $row->idSujet; ?>)">
                                <h2><?php echo $titre;?></h2>
                                <p>Créé par <?php echo $row->username;?> le <?php echo $date; ?> - 0 posts</p>
                            </div>
                            <?php
                        }
                        if (sizeof($sujets) < 1) {
                            echo "Aucun sujets pour le moments";
                        }
                    }
                    
                    ?>
                </div>
            </div>
            <div id="right">
                <div id="topicCreation">
                    <a href="./createSujet.php">Creer un sujet</a>
                </div>
                <div id="trend">
                    <h2>Les plus mouvementés</h2>
                    <ul>
                        <?php
                        array_multisort($sujets, SORT_DESC, SORT_NUMERIC, $sujets);
                        foreach ($sujets as $sujet => $nbPost) {
                            $tab = explode('|||', $sujet); //? "exemple de sujet|||idSujet"
                            $titre = $tab[0];
                            $id = $tab[1];
                            ?>
                            <a href="./afficheSujet.php?idSujet=<?php echo $id?>"><li><?php echo $titre.' - '.$nbPost.' posts';?></li></a>
                            <?php
                        }
                        ?>        
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php
        include './res/php/footer.php';
    ?>
</body>
<script src="./res/js/autoComplete.js"></script>
</html>