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
            $nom = mysqli_escape_string($co, htmlspecialchars($_POST['fname']));
            $prenom = mysqli_escape_string($co, htmlspecialchars($_POST['lname']));
            $dateNaissance = mysqli_escape_string($co, htmlspecialchars($_POST['DTN']));
            $username = mysqli_escape_string($co, htmlspecialchars($_POST['username']));
            $mail = mysqli_escape_string($co, htmlspecialchars($_POST['mail']));
            $mdp = mysqli_escape_string($co, htmlspecialchars($_POST['mdp']));
            $hashedmdp = password_hash($mdp, PASSWORD_ARGON2ID);
            $password1 = $_POST['mdp'];
            $password2 = $_POST['mdpConf'];
            $adresse = mysqli_escape_string($co, htmlspecialchars($_POST['adresse']));
            $codePostal = mysqli_escape_string($co, htmlspecialchars($_POST['CP']));
            $tel = mysqli_escape_string($co, htmlspecialchars($_POST['tel']));

            if (strcmp($password1, $password2) == 0) {
                $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                $id = $_SESSION['utilisateur']->getId();
                $result = $co->query("UPDATE utilisateur SET nom ='$nom' , prenom = '$prenom', username = '$username',  email ='$mail', mdp ='$hashedmdp', tel ='$tel', adresse ='$adresse', codepostal ='$codePostal', datenaissance ='$dateNaissance' WHERE idUtilisateur = $id;");
                $co->close();
                //! En vue d'une amélioration : Enregistrer l'image de profil dans le dossier img/profil/idUtilisateur.jpg si une image comporte le même nom, la remplacer par la nouvelle image
                // if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
                //     if ($_FILES['picture']['size'] <= 1000000) {
                //         $infosfichier = pathinfo($_FILES['picture']['name']);
                //         $extension_upload = $infosfichier['extension'];
                //         $extensions_autorisees = array('jpg', 'jpeg', 'png');
                //         if (in_array($extension_upload, $extensions_autorisees)) {
                //             move_uploaded_file($_FILES['picture']['tmp_name'], './res/img/profil/' . $id . '.' . $extension_upload);
                //         }
                //     }
                // }
                $_SESSION['utilisateur']->update();
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
    
            <form action="./profil.php?type=inscription" method="POST" enctype="multipart/form-data">
                <!-- <div class="photoprofil">
                    <input type="file" name="picture" value="" onchange="previewPicture(this)" required >
                    <img src="./res/img/profil/<?php echo $_SESSION['utilisateur']->getId();?>.png" alt="Image de profil" id="image" width="50%">
                </div> -->
                <div class="champ">
                    <label for="fname">Nom:</label>
                    <input type="text" id="fname" name="fname" value="<?php echo $_SESSION['utilisateur']->getNom();?>" placeholder="<?php echo $_SESSION['utilisateur']->getNom();?>" required>
                </div>
                <div class="champ">
                    <label for="lname">Prénom:</label>
                    <input type="text" id="lname" name="lname" value="<?php echo $_SESSION['utilisateur']->getPrenom();?>" placeholder="<?php echo $_SESSION['utilisateur']->getPrenom();?>" required>
                </div>
                <div class="champ">
                    <label for="lname">Username:</label>
                    <input type="text" id="lname" name="username" value="<?php echo $_SESSION['utilisateur']->getUsername();?>" placeholder="<?php echo $_SESSION['utilisateur']->getUsername();?>" required>
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
                        //! Calculer la date minimal pour que l'utilisateur ait au moins 15 ans
                        $date = new DateTime();
                        $date->sub(new DateInterval('P15Y'));
                        $dateMax = $date->format('Y-m-d');
                        ?>
                <div class="champ">
                    <label for="adresse">Adresse:</label>
                    <input type="text" id="Adresse" value="<?php echo $_SESSION['utilisateur']->getAdresse();?>" placeholder="<?php echo $_SESSION['utilisateur']->getAdresse();?>" name="adresse" required>
                </div>
                <div class="champ">
                    <label for="CP">Code Postal:</label>
                    <input type="number" id="CP" name="CP" value="<?php echo $_SESSION['utilisateur']->getCodePostal();?>" placeholder="<?php echo $_SESSION['utilisateur']->getCodePostal();?>" required>
                </div>
                <div class="champ">
                    <label for="tel">Tel:</label>
                    <input type="number" id="tel" name="tel" value="<?php echo $_SESSION['utilisateur']->getTel();?>" placeholder="<?php echo $_SESSION['utilisateur']->getTel();?>" required>
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