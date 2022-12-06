<?php
session_start();
require_once("./res/php/fonctions.php")
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="./res/css/forum.css">
</head>

<body>
    <?php
        include './res/php/header.php';
    ?>

    <section>
        <div class="liens">
            <a href="">Acceuil </a>
            <a href="">Forum</a>
        </div>
        <div class="container">
            <div id="left">
                <input type="text" placeholder="Rechercher un sujet">
                <div id="contenu">
                    <?php
                    $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                    //! Requete récupérant chaque sujet du forum ainsi que le nombre de posts de celui-ci et son auteur (pour l'instant son nom)
                    $result = $co->query("SELECT S.idSujet, titre, datecreation, datemodification, status, U.nom, (SELECT COUNT(*) FROM POST WHERE idSujet = S.idSujet) as nbPost FROM `SUJET` S, POST P NATURAL JOIN UTILISATEUR U;"); 
                    while ($row = $result->fetch_object()) {
                        ?>
                        <div class="topic" onclick="console.log(<?php echo $row->idSujet; ?> )">
                            <h2><?php echo $row->titre; if($row->status) {echo " [Résolu]";} ?></h2>
                            <p>Par <?php echo $row->nom;?> le <?php echo $row->datecreation; ?> - <?php echo $row->nbPost; ?> posts</p>
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
                    <h2>Tendances du moment</h2>
                    <ul>
                        <a href=""><li>Les pigeons - 20 posts</li></a>
                        <a href=""><li>Oiseaux</li></a>
                        <a href=""><li>Développement</li></a>
                        <a href=""><li>Cables</li></a>
                        <a href=""><li>Casque</li></a>
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