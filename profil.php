<!-- Script pour l'inscription ou connexion de l'utilisateur -->  
<?php 
    require_once './res/php/fonctions.php';
    session_start();
    //! Vérfication que l'user est connecté
    if (!isset($_SESSION['id'])) {
        header("Location: ./index.php");
        exit();
    } 
    if (isset($_GET['type'])) {
        if (htmlspecialchars($_GET['type']) == 'inscription') {
            $nom = htmlspecialchars($_POST['fname']);
            $prenom = htmlspecialchars($_POST['lname']);
            $dateNaissance = htmlspecialchars($_POST['DTN']);
            $adresse = "";
            $codePostal = "";
            $tel = "";
            $mail = htmlspecialchars($_POST['mail']);
            $mdp = htmlspecialchars($_POST['mdp']);
           
            if (isset($_POST['adresse']))
                $adresse = htmlspecialchars($_POST['adresse']);
            if (isset($_POST['CP']))
                $codePostal = htmlspecialchars($_POST['CP']);
            if (isset($_POST['tel'])) {
                $tel = htmlspecialchars($_POST['tel']);
            }

            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("UPDATE UTILISATEUR SET (nom, prenom, email, mdp, tel, adresse, codepostal, datenaissance, role, banni)  VALUES ('$nom','$prenom','$mail','$mdp','$tel','$adresse',$codePostal,'$dateNaissance',0,0);");
            if ($result) {
                login($mail, $mdp);
            } 
            
            else {
                header("Location: S./inscription.php?reponse=Erreur");
                exit();}
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthyVibe : Profil</title>
    <link rel="stylesheet" href="./res/css/profil.css">
    
</head>

<body>
    <?php
    include './res/php/header.php'; 
    ?>
    <section>
        <div class="liens">
            <a href="./index.php">Accueil </a>
            <p>></p>
            <a href="">Tips Ecologiques</a>
        </div>

        <div class='espaceProfil'>
            <p class="titre"> Mon profil</p>
    
            <form action="./accueil.php?&type=inscription" method="POST">
                <div class="photoprofil">
                    <form method="post" url="/upload-picture" enctype="multipart/form-data" >
                        <input type="file" name="picture" onchange="previewPicture(this)" required >
                    </form><br>
                    <img src="#" alt="" id="image" width="190px" height="200px">
                </div>
                <div class="champ">
                    <label for="fname">Nom:</label>
                    <input type="text" id="fname" name="fname" value="<?php echo $_SESSION['nom']?>" placeholder="<?php echo $_SESSION['nom']?>" required>
                </div>
                <div class="champ">
                    <label for="lname">Prénom:</label>
                    <input type="text" id="lname" name="lname" value="<?php echo $_SESSION['prenom']?>" placeholder="<?php echo $_SESSION['prenom']?>" required>
                </div>
                <div class="champ">
                    <label for="mail">Mail:</label>
                    <input type="email" id="mail" name="mail" value="<?php echo $_SESSION['email']?>" placeholder="<?php echo $_SESSION['email']?>" required>
                </div>
                <div class="champ">
                    <label for="mdp">Mot de passe:</label>
                    <input type="password" id="mdp" name="mdp" required>
                </div>
    
                <div class="champ">
                    <label for="DTN">Date de naissance:</label>
                    <input type="date" id="DTN" name="DTN" value="<?php echo $_SESSION['datenaissance']?>" required>
                </div>
                <div class="champ">
                    <label for="adresse">Adresse:</label>
                    <input type="text" id="Adresse" value="<?php echo $_SESSION['adresse']?>" placeholder="<?php echo $_SESSION['adresse']?>" name="adresse">
                </div>
                <div class="champ">
                    <label for="CP">Code Postal:</label>
                    <input type="number" id="CP" name="CP" value="<?php echo $_SESSION['codepostal']?>" placeholder="<?php echo $_SESSION['codepostal']?>" >
                </div>
                <div class="champ">
                    <label for="tel">Tel:</label>
                    <input type="number" id="tel" name="tel" value="<?php echo $_SESSION['tel']?>" placeholder="<?php echo $_SESSION['tel']?>">
                </div>
    
                <div class="boutonSinscrire">
                    <input type="button" class="sinscrire" name="S'inscrire" value="Annuler" class="sinscrire">
                    <input type="submit" class="sinscrire" name="S'inscrire" value="Modifier" class="sinscrire">
                </div>
    
            </form>
        </div>
    </section>

    <?php
    include './res/php/footer.php';
    ?>
    <script src="res/js/script.js"></script>
</body>

</html>