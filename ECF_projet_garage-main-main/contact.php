<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="style.css" rel="stylesheet"/>
    <link href="form.css" rel="stylesheet"/>
</head>
<body>
<?php
require("codb.php");
if(isset($_POST["submit"])){
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $numero = $_POST["numero"];
    $message_client = $_POST["message_client"];
if (require("codb.php")){
$dbrequete = $pdo ->prepare("INSERT INTO contact (nom,prenom,email,numero,message_client) Values (:nom,:prenom,:email,:numero,:message_client)");
$dbrequete->execute(array(
    "nom"=> $nom,
    "prenom"=> $prenom,
    "email"=> $email,
    "numero"=> $numero,
    "message_client"=> $message_client,
));
}
}
?>  
<headers>
        <nav>
        <a href="index.php"><img class="logo" src="Ressources/ECF_logo.jpg"></img></a>
            <ul>
                <a href="index.php"><li class="menunav">Achats d'occasion</li></a>
                <a href=""><li class="menunav">Ventes & Réparation</li></a>
                <a href="forum.php"><li class="menunav">Forum</li></a> 
                <a href="connexion.php"><li class="menunav">Connexion</li></a> 
            <ul>
        </nav> 
</headers>   

<content>
   
    <div class="gd-formulaire">
        <form action="contact.php" method="POST">
            <h2>Dites nous ce qui vous intérresse</h2><br>
            <div class="champs">
                <label class="titre">Nom</label><br>
                <input class="zone_de_texte" type="text" name="nom" id="Nom" value="" placeholder="Votre Nom"></input><br>
                <label class="titre">Prenom</label><br>
                <input class="zone_de_texte" type="text" name="prenom" id="prenom" value="" placeholder="Votre Prenom"></input><br>
                <label class="titre">Email</label><br>
                <input class="zone_de_texte" type="email" name="email" id="email" value="" placeholder="Votre Mail"></input><br>
                <label class="titre">Numero</label><br>
                <input class="zone_de_texte" type="int" name="numero" id="email" value="" placeholder="Votre numero" maxlength="10"></input><br>
                <h3>Laissez votre commentaire</h3>
                <textarea class="zone_de_com" rows="10" cols="40" name="message_client"></textarea>
                <input class="" type="submit" name="submit"></input>
            </div>   
            <div><b>Vous pouvez aussi nous joindre par téléphone au : 01 23 45 56 78 </b></div> 
        </form>
    </div>

</content>
<footer>
        <?php
        $horraires = $pdo->prepare("SELECT ouvre,ferme FROM horraires");
        $horraires->execute();
        $data = $horraires->fetch(PDO::FETCH_ASSOC);
        $ouvre = $data['ouvre'];
        $ferme = $data['ferme'];
         echo '<p>Le garage sera ouvert de '. $ouvre. ' h à '.$ferme. ' h du lundi au vendredi </p>'
         ?>
         
    </footer>