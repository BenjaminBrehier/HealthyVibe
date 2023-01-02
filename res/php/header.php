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
        <?php 
            $page = basename($_SERVER['PHP_SELF']);
        ?>
        <li><a href="./index.php" id="données" <?php if($page == "index.php") {echo 'class="selected"';}?>>Accueil</a></li>
        <li><a href="./vosDonnees.php" id="données" <?php if($page == "vosDonnees.php") {echo 'class="selected"';}?>>Vos données</a></li>
        <li><a href="./forum.php" id="données" <?php if($page == "forum.php") {echo 'class="selected"';}?>>Forum</a></li>
        <li><a href="./FAQ.php" <?php if($page == "FAQ.php") {echo 'class="selected"';}?>>FAQ</a></li>
        <li><a href="./tipsEcologiques.php" <?php if($page == "tipsEcologiques.php") {echo 'class="selected"';}?>>Tips ecologiques</a></li>
        <li><a href="./nousContacter.php" <?php if($page == "nousContacter.php") {echo 'class="selected"';}?>>Nous contacter</a></li>
    </ul>
    </nav>

</header>