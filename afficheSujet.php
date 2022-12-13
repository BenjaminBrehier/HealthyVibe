<?php
session_start();
require_once("./res/php/fonctions.php");
if (isset($_GET['idSujet'])) {
    $idSujet = $_GET['idSujet'];
}
else {
    header("Location: ./forum.php");
    exit();
}
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$result = $co->query("SELECT * FROM Sujet WHERE idSujet = $idSujet"); 
$row = $result->fetch_object();
$titreSujet = $row->titre;
$statusSujet = $row->status;
$idUtilisateur = $row->idUtilisateur;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="./res/css/afficheSujet.css">
    <script src="res/js/script.js"></script>
</head>

<body>
    <?php
        include './res/php/header.php';
    ?>

    <section>
        <div class="liens">
            <a href="./accueil.php">Acceuil </a>
            <p>></p>
            <a href="./forum.php">Forum</a>
            <p>></p>
            <p><?php echo $titreSujet; if($statusSujet) {echo ' [Résolu]';}?></p>
        </div>
        <?php 
        //! Si l'utilisateur est l'auteur du sujet ou l'admin, on lui permet d'accéder au bouton de fermeture
            if (($idUtilisateur == $_SESSION['id'] || $_SESSION['role']) && !$statusSujet) {
                ?>
                <button onclick="closeSubject(<?php echo $idSujet.','.$idUtilisateur;?>)">Fermer le sujet</button>
                <?php
            }
            ?>
        <div class="container">
            <?php 
            $i = 0;
            $result = $co->query("SELECT idPost, date, contenu, U.prenom, P.idUtilisateur FROM POST P INNER JOIN SUJET S ON S.idSujet = P.idSujet INNER JOIN UTILISATEUR U ON P.idUtilisateur = U.idUtilisateur WHERE P.idSujet = $idSujet ORDER BY date"); 
            while ($row = $result->fetch_object()) {
                $i++;
                ?>
                <div class="post">
                    <div class="profil">
                        <?php 
                        $md = md5($row->prenom);
                        $hex = "#" . substr($md, 0, 6);
                        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
                        $color = 'rgb(' . $r . ', ' . $g . ', ' . $b . ', 1)';
                        ?>
                        <p style="color: <?php echo $color;?>;"><?php echo $row->prenom;?></p>
                    </div>
                    <div class="contenu">
                        <p id="date"><?php echo $row->date;?></p>
                        <p><?php echo $row->contenu;?></p>
                    </div>
                    <div class="items">
                        <?php
                        if (!$statusSujet) {
                            ?>
                            <button>Répondre</button>
                            <?php
                        }
                        ?>
                        <?php
                        if ($_SESSION['role'] || $_SESSION['id'] == $row->idUtilisateur) {
                            ?>
                            <button onclick="deletePost(<?php echo $row->idPost.','.$idSujet; ?>)">Supprimer</button>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }

            if ($i == 0) {
                echo "<div class=\"alert alert-danger\">Aucun post dans ce sujet pour le moment.</div>";
            }
            if (!$statusSujet) {
                ?>

                <form action="">

                </form>
                
                <?php
            }
            ?>
        </div>    
    </section>

    <?php
        include './res/php/footer.php';
    ?>
</body>
</html>