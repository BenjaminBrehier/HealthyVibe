<?php
session_start();
require_once("./res/php/fonctions.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthyVibe</title>
    <link rel="stylesheet" href="res/css/adminPannel.css">
    <script src="res/js/script.js"></script>
</head>

<body>

    <?php
    include './res/php/header.php';
    ?>
    <section>
        <h1>Liste des utilisateurs</h1>
        <table>
            <tr>
                <th>idUtilisateur</th>
                <th>nom</th>
                <th>prenom</th>
                <th>email</th>
                <th>mdp</th>
                <th>tel</th>
                <th>adresse</th>
                <th>codepostal</th>
                <th>datenaissance</th>
                <th>role</th>
                <th>banni</th>
                <th>supprimer</th>
            </tr>
            <?php
            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("SELECT * FROM utilisateur");
            while ($row = $result->fetch_object()) {
            ?> <tr>
                    <td><?php echo $row->idUtilisateur; ?></td>
                    <td><?php echo $row->nom; ?></td>
                    <td><?php echo $row->prenom; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->mdp; ?></td>
                    <td><?php echo $row->tel; ?></td>
                    <td><?php echo $row->adresse; ?></td>
                    <td><?php echo $row->codepostal; ?></td>
                    <td><?php echo $row->datenaissance; ?></td>
                    <td><?php echo $row->role; ?></td>
                    <td><?php echo $row->banni; ?></td>
                    <td><a href="./<?php echo $row->idUtilisateur; ?>">X</a></td>
                </tr>
            <?php
            }
            ?>

        </table>
    </section>

    <?php
    include './res/php/footer.php';
    ?>
</body>

</html>