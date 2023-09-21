<?php
session_start();
if(!isset($_SESSION['admin']))
    header('Location:index.php');
?>
<?php

require("./codb.php");
if (isset($_POST['submit'])) {
    $ouvre =  htmlspecialchars( $_POST['ouverture']);
    $ferme =  htmlspecialchars($_POST['fermeture']);


if ( !empty($_POST['ouverture']) && !empty($_POST['fermeture'])){

    $dbrequete = $pdo->prepare("DROP TABLE IF EXISTS horraires");
    $dbrequete->execute();
    $dbrequete =$pdo->prepare("CREATE TABLE horraires(
        ouvre int(11) NOT NULL,
        ferme int(11) NOT NULL
    )");
    $dbrequete->execute();
    $dbrequete = $pdo->prepare("INSERT INTO horraires (ouvre,ferme) VALUES (:ouvre, :ferme)");
    $dbrequete->execute(
        array(
            "ouvre"=> $ouvre,
            "ferme"=> $ferme,  
        )
        );
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>changement d'horraires</title>
    <link href="style.css" rel="stylesheet"/>
    <link href="form.css" rel="stylesheet"/>
</head>
<body>
<headers>
        <nav>
        <a href="index.php"><img class="logo" src="Ressources/ECF_logo.jpg"></img></a>
            <ul>
                <a href="adminhorraires.php"><li class="menunav">Changement d'horraire</li></a>
                <a href="contact.php"><li class="menunav">Ventes & Réparation</li></a>
                <a href="forum.php"><li class="menunav">Forum</li></a> 
                <a href="inscription.php"><li class="menunav">Nouvel employé</li></a> 
                <a href="Deconnexion.php"><li class="menunav">Déconnexion</li></a> 
            <ul>
        </nav>        
    </headers>
<content>
    <div class="pt-formulaire">
        <form action="adminhorraires.php" method="POST">
            <h2>Changement ouverture et fermeture</h2><br>
            <div class="champs">               
                <label class="titre">ouveture</label><br>
                <input class="zone_de_texte" type="int" name="ouverture" placeholder="heure d'ouverture"></input><br>
                <label class="titre">fermeture</label><br>
                <input class="zone_de_texte" type="int" name="fermeture" placeholder="heure de fermeture"></input><br>
                <input  type="submit" name="submit"></input>
            </div>    
        </form>
    </div>
</content>
</body>
</html>