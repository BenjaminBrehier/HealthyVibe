<?php
session_start();
require_once("./res/php/fonctions.php");
if (!isset($_SESSION['id']) || $_SESSION['role'] != 1) {
    header("Location: ./index.php");
    exit();
} 
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
        <div class="liens">
            <a href="./index.php">Accueil </a>
            <p>></p>
            <a href="">Panel Admin</a>
        </div>
        <?php 
        if (isset($_GET['onglet'])&& $_GET['onglet']=='Utilisateurs') {
            ?>
        <h1>Liste des utilisateurs</h1>
        <table>
            <tr>
                <th>idUtilisateur</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Username</th>
                <th>Tel</th>
                <th>Adresse</th>
                <th>Code postal</th>
                <th>Date de naissance</th>
                <th></th>
                <th>Date début Banissement</th>
                <th>Date Fin Banissement</th>
                <th>Désactiver</th>
            </tr>
            <?php
            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("SELECT * FROM utilisateur");
            while ($row = $result->fetch_object()) {
                if($row->role == 1) continue;
            ?> <tr>
                    <td><?php echo $row->idUtilisateur; ?></td>
                    <td><?php echo $row->nom; ?></td>
                    <td><?php echo $row->prenom; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->username; ?></td>
                    <td><?php echo $row->tel; ?></td>
                    <td><?php echo $row->adresse; ?></td>
                    <td><?php echo $row->codepostal; ?></td>
                    <td><?php echo $row->datenaissance; ?></td>
                    <td></td>
                    <td><?php echo $row->dateBanDebut; ?></td>
                    <td><?php echo $row->dateBanFin; ?></td>
                    <td><input type="button" value="<?php if($row->banni) {echo 'activer" onclick="reactiverCompte('.$row->idUtilisateur.')';} else {echo 'désactiver" onclick="desactiverCompte('.$row->idUtilisateur.')';} ?>"></td>
                </tr>
            <?php
            }
            ?> 
        </table>             
            <?php
                }
                ?>

        <?php 
        if (isset($_GET['onglet'])&& $_GET['onglet']=='Lieux') {
            ?>
        <h1>Lieux de vente des casques HealthyVibe</h1>
        <table>
            <tr>
                <th>Adresse</th>
                <th>Supprimer</th>
            </tr>
            <?php
            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("SELECT * FROM lieuvente");
            while ($row = $result->fetch_object()) {
            ?> <tr>
                    <td><?php echo $row->lieu; ?></td>
                    <td><a href="<?php echo $row->idLieu; ?>">X</a></td>
                </tr>
            <?php
            }
            ?> 
        </table>             
            <?php
                }
                ?>
                <?php 

        if (isset($_GET['onglet'])&& $_GET['onglet']=='Casques') {
            ?>
        <h1>Casques et utilisateur correspondant</h1>
        <table>
            <tr>
                <th>N° de casque</th>
                <th>Nom utilisateur</th>
                <th>Prénom utilisateur</th>
                <th>Date d'achat</th>
                <th>Etat</th>
            </tr>
            <?php
            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("SELECT nom,prenom,idCasque,dateachat FROM utilisateur INNER JOIN casque ON utilisateur.idUtilisateur=casque.idUtilisateur");
            while ($row = $result->fetch_object()) {
            ?> <tr>
                    <td><?php echo $row->idCasque; ?></td>
                    <td><?php echo $row->nom; ?></td>
                    <td><?php echo $row->prenom; ?></td>
                    <td><?php echo $row->dateachat; ?></td>
                    <td><?php echo $row->dateachat; ?></td>
                </tr>
            <?php
            }
            ?> 
        </table>             
            <?php
                }
                ?>

<?php 
        if (isset($_GET['onglet'])&& $_GET['onglet']=='Forum') {
            ?>
        <h1>Liste des sujets</h1>
        <table>
            <tr>
                <th>idSujet</th>
                <th>Titre</th>
                <th>Date de création</th>
                <th>Date de modification</th>
                <th>Statut</th>

            </tr>
            <?php
            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("SELECT * FROM sujet");
            while ($row = $result->fetch_object()) {
            ?> <tr>
                    <td><?php echo $row->idSujet; ?></td>
                    <td><?php echo $row->titre; ?></td>
                    <td><?php echo $row->datecreation; ?></td>
                    <td><?php echo $row->datemodification; ?></td>
                    <td><?php echo $row->status; ?></td>
            <?php
            }
            ?> 
        </table>             
            <?php
                }
                ?>

    </section>

    <?php
    include './res/php/footer.php';
    ?>
</body>

</html>