<link rel="stylesheet" href="res/css/header.css">
<header>
    <div id="ligneVerte">
    </div>
    <div id="up">
        <a href="./index.php"><img src="./res/img/logo.png" alt="Logo de HealthyVibe"></a>
        <div  id='h2box'>
            <h2>Bienvenue dans votre espace personnel</h2>
        </div>
        <nav>
            <ul class="menu">
                <li><a href="#"><?php echo $_SESSION['prenom'].' '.$_SESSION['nom']?></a>
                    <ul class="sous-menu">
                        <a href="./profil.php"><li>Profil</li></a>
                        <?php 
                        if ($_SESSION['role']) {
                            ?>
                            <a href="./adminPanel.php"><li>Panel Admin</li></a>
                            <?php
                        }
                        ?>
                        <a href="./res/php/disconnect.php"><li>Se déconnecter</li></a>
                    </ul>
                </li>
            </ul>
        <nav>
    </div>

    <nav id='main'>
    <ul id="menu_horizontal">
        <li><a href="./index.php" id="données">Accueil</a></li>
        <li><a href="./vosDonnees.php" id="données">Vos données</a></li>
        <li><a href="./forum.php" id="données">Forum</a></li>
        <li><a href="./FAQ.php">FAQ</a></li>
        <li><a href="./tipsEcologiques.php">Tips ecologiques</a></li>
        <li><a href="./nousContacter.php">Nous contacter</a></li>
    </ul>
    </nav>

</header>