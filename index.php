<?php 
    include './res/php/fonctions.php';
    session_start();
    if (isset($_GET['type'])) {
        if (htmlspecialchars($_GET['type']) == 'inscription') {
            $nom = htmlspecialchars($_POST['fname']);
            $prenom = htmlspecialchars($_POST['lname']);
            $dateNaissance = htmlspecialchars($_POST['DTN']);
            $adresse = null;
            $codePostal = null;
            $tel = null;
            if (isset($_POST['adresse']))
                $adresse = htmlspecialchars($_POST['adresse']);
            if (isset($_POST['CP']))
                $codePostal = htmlspecialchars($_POST['CP']);
            if (isset($_POST['tel'])) {
                $tel = htmlspecialchars($_POST['tel']);
            }
            $username = htmlspecialchars($_POST['username']);
            $mail = htmlspecialchars($_POST['mail']);
            $mdp = htmlspecialchars($_POST['mdp']);
            $hashedmdp = password_hash($mdp, PASSWORD_ARGON2ID);

            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("INSERT INTO UTILISATEUR(nom, prenom, username, email, mdp, tel, adresse, codepostal, datenaissance) VALUES ('$nom','$prenom','$username', '$mail','$hashedmdp','$tel','$adresse',$codePostal,'$dateNaissance');");
            if ($result) {
                login($mail, $mdp);
            } else {
                header("Location: ./inscription.php?reponse=Erreur");
                exit();
            }
        }
        else if (htmlspecialchars($_GET['type']) == 'connexion') {
            if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
                $mail = htmlspecialchars($_POST['mail']);
                $mdp = htmlspecialchars($_POST['mdp']);
                login($mail, $mdp);
            }
        } 
        else {
            //! Url de connexion incorrect 
            header("Location: ./connexion.php?reponse=Erreur");
            exit();
        }
    }
    // else {
    //     //! Url de connexion incorrect
    //     header("Location: ./connexion.php?reponse=Erreur");
    //     exit();
    // }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthyVibe</title>
    <link rel="stylesheet" href="res/css/index.css">
    <script src="res/js/script.js"></script>
</head>

<body>
    <?php
    if (isset($_SESSION['utilisateur']) && ($_SESSION['utilisateur'] instanceof Utilisateur)) {
        include './res/php/header.php';
    } else {
        include './res/php/headerVisiteur.php';
    }
    ?>
    <section id="presentation">
        <h1>HealthyVibe</h1>
        <div>
            <p>Le nouveau casque économique de bien être</p>
            <a href="./acheter.php" id="acheter">Acheter ></a>
        </div>
        <img src="./res/img/casque.jpg" alt="Image du casque">
    </section>

    <section id="fonctions"> 
        
        <div class="container1">
            <div>
                <h1>Des fonctionnalités inédites</h1>
                <p><strong>HealthyVibe</strong> a été soigneusement conçu pour veiller à ce que son utilisateur soit dans les meilleures conditions possibles pour sa santé et son bien-être.</p>
            </div>
            <img src="./res/img/casqueEnvironnement.webp">
        </div> 

        <div class="container2"> 
            <img src="./res/img/casqueSport.webp">
            <div>
                <h1>Pour votre santé </h1>
                <p><strong>HealthyVibe</strong> vous permet de visualiser votre rythme cardiaque par des graphiques clairs mais 
                aussi du débit sonore. </p>
            </div>
        </div>

        <div class="container1">
            <div>
                <h1>Pour le bien de notre environnement </h1>
                <p>Parce que l’environnement est une priorité pour <strong>HealthyVibe</strong>.
                 Notre casque récolte en temps réel les données environnementales qui vous entoure. </p>
            </div>
            <img src="./res/img/fonctionnalite_2.png">   
        </div>

        <div class="container2">
            <img src="./res/img/casqueChantier.jpg">
            <div>
                <h1>Pour votre sécurité </h1>
                <p>Notre casque <strong>HealthyVibe</strong>, peut vous avertir d’un danger lié à une présence 
                trop élevé de monoxyde de carbone à proximité de votre localisation, grâce à nos capteurs performants.</p>
            </div>   
           
        </div>


    </section>
    <?php
    include './res/php/footer.php';
    ?>
</body>

</html>