<?php
include './res/php/fonctions.php';
session_start();
if (!isset($_SESSION['utilisateur']) || !($_SESSION['utilisateur'] instanceof Utilisateur) || $_SESSION['utilisateur']->getRole() != 1) {
    header("Location: ./index.php");
    exit();
} 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthyVibe : Admin Panel</title>
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
        <div class='ajout'>
            <input type='text' placeholder='Nouveau lieu de vente' class='inputnew' required>      
            <a class='boutonModification' href=''>Ajouter un lieu de vente</a>
        </div>
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
                <th>Actif</th>
            </tr>
            <?php
            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("SELECT nom,prenom,idCasque,dateachat, actif FROM Utilisateur INNER JOIN casque ON utilisateur.idUtilisateur=casque.idUtilisateur");
            while ($row = $result->fetch_object()) {
            ?> <tr>
                    <td><?php echo $row->idCasque; ?></td>
                    <td><?php echo $row->nom; ?></td>
                    <td><?php echo $row->prenom; ?></td>
                    <td><?php echo $row->dateachat; ?></td>
                    <td><?php if($row->actif) { ?> <button onclick="window.location.href = './res/php/desactiverCasque.php?actif=0&idCasque=<?php echo $row->idCasque;?>'">Oui</button> <?php } else { ?> <button onclick="window.location.href = './res/php/desactiverCasque.php?actif=1&idCasque=<?php echo $row->idCasque;?>'">Non</button> <?php } ?></td>
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
                <th></th>
                <th>Fermer</th>
                <th>Supprimer</th>

            </tr>
            <?php
            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("SELECT * FROM sujet");
            $admin = 'admin';
            while ($row = $result->fetch_object()) {
            ?> <tr>
                    <td><?php echo $row->idSujet; ?></td>
                    <td><?php echo $row->titre; ?></td>
                    <td><?php echo $row->datecreation; ?></td>
                    <td><?php echo $row->datemodification; ?></td>
                    <td><?php if($row->status) {echo 'Résolu';} else {echo 'Non résolu';} ?></td>
                    <td></td>
                    <td><?php if(!$row->status) {?><button onclick="closeSubject(<?php echo $row->idSujet.','.$row->idUtilisateur.',0'?>)">Fermer</button><?php } ?></td>
                    <td><button onclick="deleteSubject(<?php echo $row->idSujet.',0';?>)">X</button></td>
            <?php
            }
            ?> 
        </table>             
            <?php
                }
            

        if (isset($_GET['onglet'])&& $_GET['onglet']=='FAQ') {
            ?>
        <h1>Question / réponses de la FAQ</h1>
        <div class='ajout'>
            <textarea type='text' placeholder='Question' class='inputnew' required></textarea>           
            <textarea type='text' placeholder='Réponse' class="inputnew" required></textarea>      
            <a class='boutonModification' href=''>Ajouter une nouvelle question/réponse</a>
        </div>

        <table>
            <tr>
                <th class='idChamp'>N° de la question</th>
                <th>Question</th>
                <th>Réponse</th>
                <th class="Supprimer">Supprimer</th>
            </tr>
            <?php
            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("SELECT * FROM FAQ");
            while ($row = $result->fetch_object()) {
            ?> <tr>
                    <td><?php echo $row->idFaq; ?></td>
                    <td><?php echo $row->question; ?></td>
                    <td><?php echo $row->reponse; ?></td>
                    <td><a href=''>X</a></td>
                </tr>
            <?php
            }
            ?> 
        </table>             
            <?php
            }
            ?>
         
        <?php
        
        if (isset($_GET['onglet'])&& $_GET['onglet']=='TipsEcologiques') {
        ?>
        <h1>Liste des tips écologiques</h1>
        <div class='ajout'>
            <input type='text' placeholder='Tips' class='inputnew' required>           
            <input type='text' placeholder='Lien Video' id="Lien">
            <a class='boutonModification' href=''>Ajouter un Tips écologique</a>
        </div>
        <table>
            <tr>
                <th class='idChamp'>idTips</th>
                <th>Tips</th>
                <th>Lien vidéo</th>
                <th class="Supprimer">Supprimer</th>
            </tr>
            <?php
            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("SELECT * FROM tipsEco");
            while ($row = $result->fetch_object()) {
            ?> <tr>
                    <td><?php echo $row->idTips; ?></td>
                    <td><?php echo $row->contenu; ?></td>
                    <td><?php echo $row->lienVideo; ?></td>
                    <td>X</td>
            <?php
            }
            ?> 
        </table>             
            <?php
                }

        if (isset($_GET['onglet'])&& $_GET['onglet']=='Message') {
            ?>
        <h1>Messagerie avec les utilisateurs</h1>
        <table>
            <tr>
                <th class='idChamp'>id Utilisateur</th>
                <th class='idChamp'>Date</th>
                <th>Contenu</th>
            </tr>
            <?php
            $co = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $result = $co->query("SELECT * FROM messagedirect");
            while ($row = $result->fetch_object()) {
            ?> 
                <tr>
                    <td><?php echo $row->idUtilisateur; ?></td>
                    <td><?php echo $row->date; ?></td>
                    <td><?php echo $row->contenu; ?></td>
                </tr>
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
<script src="./res/js/script.js"></script>
</html>