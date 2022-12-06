<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="./res/css/forum.css">
</head>

<body>
    <?php
        include './res/php/header.php';
    ?>

    <section>
        <div class="liens">
            <a href="">Acceuil </a>
            <a href="">Forum</a>
        </div>
        <div class="container">
            <div id="left">
                <input type="text" placeholder="Rechercher un sujet">
                <div id="contenu">
                    <div class="topic" onclick="console.log('test')">
                        <h2>Pourquoi les abeilles volent ? [Résolu]</h2>
                        <p>Par Michel le <?php echo date("d/m/Y") ?> - 2 posts</p>
                    </div>
                    <div class="topic">
                        <h2>Pourquoi les pigeons volent ?</h2>
                        <p>Par Kevin le <?php echo date("d/m/Y") ?> - 40 posts</p>
                    </div>
                    <div class="topic">
                        <h2>Pourquoi les oiseaux volent ?</h2>
                        <p>Par AlexandreDu78 le <?php echo date("d/m/Y") ?> - 32 posts</p>
                    </div>
                    <div class="topic">
                        <h2>Pourquoi les poissons volent ?</h2>
                        <p>Par Theo le <?php echo date("d/m/Y") ?> - pas de posts</p>
                    </div>
                </div>
            </div>
            <div id="right">
                <div id="topicCreation">
                    <a href="">Creer un topic</a>
                </div>
                <div id="trend">
                    <h2>Tendances du moment</h2>
                    <ul>
                        <a href=""><li>Les pigeons - 20 posts</li></a>
                        <a href=""><li>Oiseaux</li></a>
                        <a href=""><li>Développement</li></a>
                        <a href=""><li>Cables</li></a>
                        <a href=""><li>Casque</li></a>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php
        include './res/php/footer.php';
    ?>
</body>
</html>