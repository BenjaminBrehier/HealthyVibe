<?php
session_start();
require_once("./res/php/fonctions.php");
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
            <a href="./accueil.php?type=connexion">Acceuil </a>
            <p>></p>
            <a href="./forum.php">Forum</a>
        </div>
        <div class="container">
            <div id="left">
                <input type="text" placeholder="Rechercher un sujet">
                <div id="contenu">
                    <?php
                    $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                    //! Requete récupérant chaque sujets du forum ainsi que le nombre de posts de celui-ci et son auteur (pour l'instant son nom)
                    $result = $co->query("SELECT DISTINCT S.idSujet, titre, datecreation, datemodification, status, U.nom, (SELECT COUNT(*) FROM POST WHERE idSujet = S.idSujet) as nbPost FROM `SUJET` S, POST P NATURAL JOIN UTILISATEUR U ORDER BY datecreation;"); 
                    while ($row = $result->fetch_object()) {
                        $sujets[$row->titre.'|||'.$row->idSujet] = $row->nbPost; 
                        $date = date("d-m-Y", strtotime($row->datecreation));  
                        ?>
                        <div class="topic" onclick="afficher(<?php echo $row->idSujet; ?>)">
                            <h2><?php echo $row->titre; if($row->status) {echo " [Résolu]";} ?></h2>
                            <p>Par <?php echo $row->nom;?> le <?php echo $date; ?> - <?php echo $row->nbPost; ?> posts</p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div id="right">
                <div id="topicCreation">
                    <a href="">Creer un topic</a>
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
</html>