<?php
//! Page de création d'un sujet et du prémier post
include './res/php/fonctions.php';
session_start();
//! Vérfication que l'user est connecté
if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
    header("Location: ./index.php");
    exit();
} 
if (isset($_POST['nomSujet']) && isset($_POST['contenu'])) {
    $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $nomSujet = mysqli_escape_string($co, htmlspecialchars($_POST['nomSujet']));
    $contenu = mysqli_escape_string($co, htmlspecialchars($_POST['contenu']));
    $id = mysqli_real_escape_string($co, $_SESSION['utilisateur']->getId());
    $date = date("Y-m-d H:i:s");
    
    $req = $co->query("INSERT INTO sujet (titre, datecreation, datemodification, status, idUtilisateur) VALUES ('$nomSujet', '$date', '$date', 0, $id)"); 
    $req = $co->query("SELECT idSujet FROM sujet ORDER BY idSujet DESC LIMIT 1"); 
    if ($req->num_rows > 0) {
        $row = $req->fetch_object();
        $idSujet = $row->idSujet;
        $req = $co->query("INSERT INTO post(date, contenu, idUtilisateur, idSujet, idReponse) VALUES ('$date','$contenu', $id, $idSujet, NULL)"); 
        header("Location: ./afficheSujet.php?idSujet=$idSujet");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="./res/css/createTopic.css">
</head>

<body>
    <?php
        include './res/php/header.php';
    ?>

    <section>
        <div class="liens">
            <a href="./index.php">Acceuil </a>
            <p>></p>
            <a href="./forum.php">Forum</a>
            <p>></p>
            <p>Création d'un sujet</p>
        </div>
        <form action="" method="POST">
            <label for="NomSujet">Nom du sujet</label>
            <input type="text" name="nomSujet" placeholder="Nom du sujet" required>
            
            <label for="">Premier post</label>
            <textarea name="contenu" placeholder="Premier post" cols="40" rows="20" required></textarea>
            
            
            <input type="submit" value="Créer sujet">
        </form>
    </section>

    <?php
        include './res/php/footer.php';
    ?>
</body>
</html>