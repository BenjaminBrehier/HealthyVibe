<link rel="stylesheet" href="res/css/header.css">
<header>
    <div id="ligneVerte">
    </div>
    <div id="up">
        <a href="./index.php"><img src="./res/img/logo.png" alt="Logo de HealthyVibe"></a>
        <div  id='h2box'>
            <?php
            $page = basename($_SERVER['PHP_SELF']);

            if ($page=="adminPanel.php") {
                ?>
                <h2>Administrateur</h2>
                <?php
                }
            else {
                ?><h2>HealthyVibe</h2>
            <?php
            }
            ?>
        </div>
        <nav>
            <ul class="menu">
                <li><a href="#"><?php echo $_SESSION['utilisateur']->getPrenom().' '.$_SESSION['utilisateur']->getNom()?></a>
                    <ul class="sous-menu">
                        <a href="./profil.php"><li>Profil</li></a>
                        <?php 
                        if ($_SESSION['utilisateur']->getRole()) {
                            ?>
                            <a href="./adminPanel.php?onglet=Utilisateurs"><li>Panel Admin</li></a>
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

          if ($page=="adminPanel.php") {
            ?>
                <li><a href="./index.php" <?php if($page == "./index.php") {echo 'class="selected"';}?>>Accueil</a></li>
                <li><a href="./adminPanel.php?onglet=Utilisateurs" id="données" <?php if($_GET["onglet"] == "Utilisateurs") {echo 'class="selected"';}?>>Utilisateurs</a></li>
                <li><a href="./adminPanel.php?onglet=Casques" id="données" <?php if($_GET["onglet"] == "Casques") {echo 'class="selected"';}?>>Casques</a></li>
                <li><a href="./adminPanel.php?onglet=Forum" id="données" <?php if($_GET["onglet"]== "Forum") {echo 'class="selected"';}?>>Forum</a></li>
                <li><a href="./adminPanel.php?onglet=FAQ" <?php if($_GET["onglet"] == "FAQ") {echo 'class="selected"';}?>>FAQ</a></li>
                <li><a href="./adminPanel.php?onglet=TipsEcologiques" <?php if($_GET["onglet"]== "TipsEcologiques") {echo 'class="selected"';}?>>Tips ecologiques</a></li>
                <li><a href="./adminPanel.php?onglet=lieuvente" <?php if($_GET["onglet"] == "Lieux") {echo 'class="selected"';}?>>Lieux de vente</a></li>
                <li><a href="./adminPanel.php?onglet=Message" <?php if($_GET["onglet"] == "Message") {echo 'class="selected"';}?>>Messages</a></li>
            <?php
            } 
            else {
                ?>
                <li><a href="./index.php" id="données" <?php if($page == "index.php") {echo 'class="selected"';}?>>Accueil</a></li>
                <li><a href="./vosDonnees.php" id="données" <?php if($page == "vosDonnees.php") {echo 'class="selected"';}?>>Vos données</a></li>
                <li><a href="./forum.php" id="données" <?php if($page == "forum.php") {echo 'class="selected"';}?>>Forum</a></li>
                <li><a href="./FAQ.php" <?php if($page == "FAQ.php") {echo 'class="selected"';}?>>FAQ</a></li>
                <li><a href="./tipsEcologiques.php" <?php if($page == "tipsEcologiques.php") {echo 'class="selected"';}?>>Tips ecologiques</a></li>
                <li><a href="./nousContacter.php" <?php if($page == "nousContacter.php") {echo 'class="selected"';}?>>Nous contacter</a></li>
                <?php
                }

            ?>
    </ul>
    </nav>  

</header>