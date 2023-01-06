<?php
session_start();
//! Vérfication que l'user est connecté
if (!isset($_SESSION['id'])) {
    header("Location: ./index.php");
    exit();
} 
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
//! Si la requete n'a renvoyé aucune ligne, on redirige vers le forum
if ($row == null) {
    header("Location:./forum.php");
    exit();
}
$titreSujet = $row->titre;
$statusSujet = $row->status;
$idUtilisateur = $row->idUtilisateur;
$posts = array();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="./res/css/afficheSujet.css">
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
            <p>></p>
            <a href=""><?php echo $titreSujet; if($statusSujet) {echo ' [Résolu]';}?></a>
        </div>
        <?php 
            //! Si l'utilisateur est l'auteur du sujet ou l'admin, on lui permet d'accéder au bouton de fermeture
            if (($idUtilisateur == $_SESSION['id'] || $_SESSION['role']) && !$statusSujet) {
                ?>
                <button onclick="closeSubject(<?php echo $idSujet.','.$idUtilisateur;?>)">Fermer le sujet</button>
                <?php
            }
            //! Si l'utilisateur est l'admin, on lui permet d'accéder au bouton de suppression
            if (($_SESSION['role'])) {
                ?>
                <button onclick="deleteSubject(<?php echo $idSujet;?>)">Supprimer le sujet</button>
                <?php
            }
            ?>
        <div class="container">
            <?php 
            $i = 0;
            $result = $co->query("SELECT idPost, date, contenu, U.prenom, P.idUtilisateur, idReponse FROM POST P INNER JOIN SUJET S ON S.idSujet = P.idSujet INNER JOIN UTILISATEUR U ON P.idUtilisateur = U.idUtilisateur WHERE P.idSujet = $idSujet ORDER BY date"); 
            while ($row = $result->fetch_object()) {
                $i++;
                $posts[$row->idPost] = $row->prenom.'|'.$row->date.'|'.$row->contenu;
                $date = date("d-m-Y H:i:s", strtotime($row->date));
                ?>
                <div class="post" id="<?php echo $row->idPost; ?>" style="border-left: 3px solid <?php echo getColor($row->prenom);?>;">
                    <div class="profil">
                        <p style="color: <?php echo getColor($row->prenom);?>;"><?php echo $row->prenom;?></p>
                    </div>
                    <div class="contenu">
                        <p class="date"><?php echo $date;?></p>
                        <?php 
                        if ($row->idReponse != null) {
                            $tab = explode('|', $posts[$row->idReponse]);
                            ?>
                            <div class="reponse" style="border-left: 3px solid <?php echo getColor($tab[0]);?>;">
                                <p style="color: <?php echo getColor($tab[0]);?>;"><?php echo $tab[0]?></p>
                                <p><?php echo $tab[1]?></p>
                                <p><?php echo $tab[2]?></p>
                            </div>
                            <?php
                        }
                        ?>
                        <p><?php echo $row->contenu;?></p>
                    </div>
                    <div class="items">
                        <?php
                        if (!$statusSujet) {
                            ?>
                            <button onclick="repondre(<?php echo $row->idPost;?>)">Répondre</button>
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
                echo "<div>Aucun post dans ce sujet pour le moment.</div>";
            }
            if (!$statusSujet) {
                ?>
                <br>
                <hr>
                <br>
                <form id="form" action="./res/php/newPost.php?idSujet=<?php echo $idSujet;?>" method="post">
                    <div id="divReponse">
                        <input type="button" onclick="nonRepondre()" value="Ne plus répondre" formnovalidate>
                        <div id="contenuReponse"></div>
                    </div>
                    <input id="idPost" type="hidden" name="idPost" value="null">
                    <textarea name="contenu" placeholder="Nouveau post" cols="40" rows="10" required></textarea>
                    <input type="submit" value="Publier post">
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
<script src="res/js/script.js"></script>
</html>