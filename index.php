<?php 
    //! Acceuil du siteWeb ainsi que script de connexion et d'inscription d'un utilisateur
    include './res/php/fonctions.php';
    session_start();
    if (isset($_GET['type'])) {
        if (htmlspecialchars($_GET['type']) == 'inscription') {
            //! Inscription d'un utilisateur
            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            //! Vérification de l'unicité de l'email et du username
            $mail = mysqli_escape_string($co, htmlspecialchars($_POST['mail']));
            $result = $co->query("SELECT * FROM utilisateur WHERE email = '$mail' LIMIT 1");
            if ($result->num_rows > 0) {
                header("Location: ./inscription.php?reponse=Email déjà utilisé");
                exit();
            }
            $username = mysqli_escape_string($co, htmlspecialchars($_POST['username']));
            $result = $co->query("SELECT * FROM utilisateur WHERE username = '$username' LIMIT 1");
            if ($result->num_rows > 0) {
                header("Location: ./inscription.php?reponse=Username déjà utilisé");
                exit();
            }
            $nom = mysqli_escape_string($co, htmlspecialchars($_POST['fname']));
            $prenom = mysqli_escape_string($co, htmlspecialchars($_POST['lname']));
            $dateNaissance = mysqli_escape_string($co, htmlspecialchars($_POST['DTN']));
            $adresse = mysqli_escape_string($co, htmlspecialchars($_POST['adresse']));
            $codePostal = mysqli_escape_string($co, htmlspecialchars($_POST['CP']));
            $tel = mysqli_escape_string($co, htmlspecialchars($_POST['tel']));
            $mdp = mysqli_escape_string($co, htmlspecialchars($_POST['mdp']));
            $hashedmdp = password_hash($mdp, PASSWORD_ARGON2ID);

            $result = $co->query("INSERT INTO utilisateur(nom, prenom, username, email, mdp, tel, adresse, codepostal, datenaissance) VALUES ('$nom','$prenom','$username', '$mail','$hashedmdp','$tel','$adresse',$codePostal,'$dateNaissance');");
            if ($result) {
                login($mail, $mdp);
            } else {
                header("Location: ./inscription.php?reponse=Erreur");
                exit();
            }
        }
        else if (htmlspecialchars($_GET['type']) == 'connexion') {
            //! Connexion d'un utilisateur
            if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur)) {
                $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                $mail = mysqli_escape_string($co, htmlspecialchars($_POST['mail']));
                $mdp = mysqli_escape_string($co, htmlspecialchars($_POST['mdp']));
                login($mail, $mdp);
            }
        } 
        else {
            //! Url de connexion incorrect 
            header("Location: ./connexion.php?reponse=Erreur");
            exit();
        }
    }
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
        <img class='imgCasque' src="./res/img/casque.jpg" alt="Image du casque">
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