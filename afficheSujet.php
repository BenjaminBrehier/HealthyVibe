<?php
//! Permet d'afficher les posts d'un sujet
include './res/php/fonctions.php';
session_start();
//! Vérfication que l'user est connecté
if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 
if (isset($_GET['idSujet'])) {
    $idSujet = $_GET['idSujet'];
}
else {
    header("Location: ./forum.php");
    exit();
}
$co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$result = $co->query("SELECT * FROM sujet WHERE idSujet = $idSujet"); 
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
            //! Si l'utilisateur est l'auteur du sujet ou l'admin, on lui permet d'accéder au bouton de fermeture si le sujet est encore ouvert
            if (($idUtilisateur == $_SESSION['utilisateur']->getId() || $_SESSION['utilisateur']->getRole()) && !$statusSujet) {
                ?>
                <button onclick="closeSubject(<?php echo $idSujet.',1';?>)">Fermer le sujet</button>
                <?php
            }
            //! Si l'utilisateur est l'admin, on lui permet d'accéder au bouton de suppression
            if (($_SESSION['utilisateur']->getRole())) {
                ?>
                <button onclick="deleteSubject(<?php echo $idSujet.',1';?>)">Supprimer le sujet</button>
                <?php
            }
            ?>
        <div class="container">
            <?php 
            $i = 0;
            $result = $co->query("SELECT idPost, date, contenu, U.username, P.idUtilisateur, idReponse FROM post P INNER JOIN sujet S ON S.idSujet = P.idSujet INNER JOIN utilisateur U ON P.idUtilisateur = U.idUtilisateur WHERE P.idSujet = $idSujet ORDER BY date"); 
            while ($row = $result->fetch_object()) {
                $i++;
                //! On stocke dans un tableau les valeurs de chaques postes pour pouvoir les afficher en tant que réponse ensuite (ligne 86)
                $posts[$row->idPost] = $row->username.'|'.$row->date.'|'.$row->contenu;
                $date = date("d-m-Y H:i:s", strtotime($row->date));
                ?>
                <div class="post" id="<?php echo $row->idPost; ?>" style="border-left: 3px solid <?php echo getColor($row->username);?>;">
                    <div class="profil">
                        <p style="color: <?php echo getColor($row->username);?>;"><?php echo $row->username;?></p>
                    </div>
                    <div class="contenu">
                        <p class="date"><?php echo $date;?></p>
                        <?php 
                        if ($row->idReponse != null) {
                            $tab = explode('|', $posts[$row->idReponse]);
                            ?>
                            <div class="reponse" name="<?php echo $row->idReponse;?>" style="border-left: 3px solid <?php echo getColor($tab[0]);?>;">
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
                        if ($_SESSION['utilisateur']->getRole() || ($_SESSION['utilisateur']->getId() == $row->idUtilisateur && !$statusSujet)) {
                            ?>
                            <button onclick="deletePost(<?php echo $row->idPost.','.$idSujet.','.$row->idUtilisateur; ?>)">Supprimer</button>
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