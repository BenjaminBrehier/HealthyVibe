<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthyVibe</title>
    <link rel="stylesheet" href="res/css/index.css">
    <script src="res/js/script.js"></script>
</head>

<body>
    <header>
        <div id="ligneVerte"></div>
        <img src="./res/img/logo.png" alt="Logo de HealthyVibe">
        <nav>
            <a href="./tipsEcologiquesVisiteur">Tips ecologiques</a>
            <a href="./FAQVisiteur.php">FAQ</a>
            <a href="./connexion.php" id="co">Se connecter</a>
            <a href="./inscription.php" id="inscrire">S'inscrire</a>
        </nav>
    </header>
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
            <img src="./res/img/fonctionnalite_5.jpg">
        </div> 

        <div class="container2"> 
            <img src="./res/img/fonctionnalite_1.png">
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
            <img src="./res/img/fonctionnalite_4.jpg">
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