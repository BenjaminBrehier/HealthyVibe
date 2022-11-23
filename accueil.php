<!-- Script pour l'inscription ou connexion de l'utilisateur -->
<?php 
    require_once './res/php/fonctions.php';
    session_start();
    if (isset($_GET['type'])) {
        if (htmlspecialchars($_GET['type']) == 'inscription') {
            $nom = htmlspecialchars($_POST['fname']);
            $prenom = htmlspecialchars($_POST['lname']);
            $dateNaissance = htmlspecialchars($_POST['DTN']);
            $adresse = "";
            $codePostal = "";
            if (isset($_POST['adresse']))
                $adresse = htmlspecialchars($_POST['adresse']);
            if (isset($_POST['CP']))
                $codePostal = htmlspecialchars($_POST['CP']);

            $mail = htmlspecialchars($_POST['mail']);
            $tel = htmlspecialchars($_POST['tel']);
            $mdp = htmlspecialchars($_POST['mdp']);

            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("INSERT INTO UTILISATEUR(nomm, prenom, email, mdp, tel, adresse, codepostal, datenaissance, role, banni) VALUES ('$nom','$prenom','$mail','$mdp','$tel','$adresse',$codePostal,'$dateNaissance',0,0);");
            if ($result) {
                login($mail, $mdp);
            } else {
                header("Location: ./inscription.php?reponse=Erreur");
                exit();
            }
        }
        else if ($_GET['type'] == 'connexion') {
            $mail = htmlspecialchars($_POST['mail']);
            $mdp = htmlspecialchars($_POST['mdp']);
            login($mail, $mdp);
        } 
        else {
            //! Url de connexion incorrect 
            header("Location: ./connexion.php?reponse=Erreur");
            exit();
        }
    }
    else {
        //! Url de connexion incorrect
        header("Location: ./connexion.php?reponse=Erreur");
        exit();
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthyVibe</title>
    <link rel="stylesheet" href="res/css/accueil.css">
    <script src="res/js/script.js"></script>
</head>

<body>
    <?php
    include './res/php/header.php';
    ?>
    <section id="presentation">
        <h1>HealthyVibe</h1>
        <div>
            <p>Le nouveau casque économique de bien être</p>
            <a href="" id="acheter">Acheter ></a>
        </div>
        <img src="./res/img/casque.jpg" alt="Image du casque">
    </section>
    <section id="fonctions">

    </section>
    <?php
    include './res/php/footer.php';
    ?>
</body>

</html>