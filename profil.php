<!-- Script pour la modification des données de l'utilisateur -->  
<?php 
    include './res/php/fonctions.php';
    session_start();
    //! Vérfication que l'user est connecté
    if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
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
            $hashedmdp = password_hash($mdp, PASSWORD_ARGON2ID);
            $password1 = $_POST['mdp'];
            $password2 = $_POST['mdpConf'];
           
            if (isset($_POST['adresse'])) {
                $adresse = htmlspecialchars($_POST['adresse']);
            }
            if (isset($_POST['CP'])){
                $codePostal = htmlspecialchars($_POST['CP']);
            }
            if (isset($_POST['tel'])) {
                $tel = htmlspecialchars($_POST['tel']);
            }
            if (strcmp($password1, $password2) == 0) {
                $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                $id = $_SESSION['utilisateur'];
                $result = $co->query("UPDATE utilisateur SET nom ='$nom' , prenom = '$prenom' , email ='$mail', mdp ='$hashedmdp', tel ='$tel', adresse ='$adresse', codepostal ='$codePostal', datenaissance ='$dateNaissance' WHERE idUtilisateur = $id;");
            }else{
            $testvar = "Les mots de passe ne sont pas identiques. Veuillez rééssayer.";
            }
    
        }
        
        else{
            header("Location: S./inscription.php?reponse=Erreur");
            exit();}
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
    
            <form action="./profil.php?type=inscription" method="POST">
                <div class="photoprofil">
                    <input type="file" name="picture" onchange="previewPicture(this)" required >
                    <img src="#" alt="" id="image" width="190px" height="200px">
                </div>
                <div class="champ">
                    <label for="fname">Nom:</label>
                    <input type="text" id="fname" name="fname" value="<?php echo $_SESSION['utilisateur']->getNom();?>" placeholder="<?php echo $_SESSION['utilisateur']->getNom();?>" required>
                </div>
                <div class="champ">
                    <label for="lname">Prénom:</label>
                    <input type="text" id="lname" name="lname" value="<?php echo $_SESSION['utilisateur']->getPrenom();?>" placeholder="<?php echo $_SESSION['utilisateur']->getPrenom();?>" required>
                </div>
                <div class="champ">
                    <label for="mail">Mail:</label>
                    <input type="email" id="mail" name="mail" value="<?php echo $_SESSION['utilisateur']->getMail();?>" placeholder="<?php echo $_SESSION['utilisateur']->getMail();?>" required>
                </div>
                <div class="champ">
                    <label for="mdp">Mot de passe:</label>
                    <input type="password" id="mdp" name="mdp" required>
                </div>
                <div class="champ">
                    <label for="mdp">Confirmer le mot de passe:</label>
                    <input type="password" id="mdpConf" name="mdpConf" required>
                </div>
                <?php
                if (isset($_GET['type'])) {
                    if (htmlspecialchars($_GET['type']) == 'inscription') {
                        if (strcmp($password1, $password2) !== 0) {
                            echo "<p class=msgErreurMdp>$testvar</p>";
                        }
                    }
                }
                ?>
                <div class="champ">
                    <label for="DTN">Date de naissance:</label>
                    <input type="date" id="DTN" name="DTN" value="<?php echo $_SESSION['utilisateur']->getDateNaissance();?>" required>
                </div>
                <?php 
                        //Calculer la date minimal pour que l'utilisateur ait au moins 15 ans
                        $date = new DateTime();
                        $date->sub(new DateInterval('P15Y'));
                        $dateMax = $date->format('Y-m-d');
                        ?>
                <div class="champ">
                    <label for="adresse">Adresse:</label>
                    <input type="text" id="Adresse" value="<?php echo $_SESSION['utilisateur']->getAdresse();?>" placeholder="<?php echo $_SESSION['utilisateur']->getAdresse();?>" name="adresse">
                </div>
                <div class="champ">
                    <label for="CP">Code Postal:</label>
                    <input type="number" id="CP" name="CP" value="<?php echo $_SESSION['utilisateur']->getCodePostal();?>" placeholder="<?php echo $_SESSION['utilisateur']->getCodePostal();?>" >
                </div>
                <div class="champ">
                    <label for="tel">Tel:</label>
                    <input type="number" id="tel" name="tel" value="<?php echo $_SESSION['utilisateur']->getTel();?>" placeholder="<?php echo $_SESSION['utilisateur']->getTel();?>">
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