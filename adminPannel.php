<?php 
    session_start();
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
<table>
<tr>
            <th>idUtilisateur</th><th>Nom</th><th>Prénom</th><th>email</th><th>mdp</th><th>tel</th><th>adresse</th><th>codepostal</th><th>datenaissance</th><th>role</th><th>banni</th>
            </tr>
            <tr>
            <td>1</td><td>AdminNom</td><td>Admin</td><td>admin@gmail.com</td><td>admin</td><td>192168</td><td>1 rue du web</td><td>192</td><td>1970-01-01</td><td>0</td><td>0</td>
            </tr>

</table>








    <?php
    include './res/php/footer.php';
    ?>
</body>
</html>