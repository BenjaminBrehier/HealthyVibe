<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthyVibe : Profil</title>
    <link rel="stylesheet" href="./res/css/profil.css">
    <script src="res/js/script.js"></script>
</head>

<body>
    <?php
    include './res/php/header.php';
    ?>

    <div class='espaceProfil'>
        <p class="titre"> Mon profil</p>

        <form action="./accueil.php?&type=inscription" method="POST">
            <div class="champ">
                <form method="post" url="/upload-picture" enctype="multipart/form-data" >
                    <input type="file" name="picture" onchange="previewPicture(this)" required >
                </form>
                <img src="#" alt="" id="image" style="max-width: 500px; margin-top: 20px;" >
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

    <?php
    include './res/php/footer.php';
    ?>
</body>

</html>