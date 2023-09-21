<?php
session_start();
if(!isset($_session['admin']))
    header('Location:index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'inscrption</title>
    <link href="style1.css" rel="stylesheet"/>
    <link href="form1.css" rel="stylesheet"/>
</head>
<?php
require("./codb.php");
if (isset($_POST['submit'])) {
    $nom =  htmlspecialchars( $_POST['nom']);
    $prenom =  htmlspecialchars($_POST['prenom']);
    $email =  htmlspecialchars( $_POST['email']);
    $password =  htmlspecialchars($_POST['mot_de_passe']);
    $password2 = htmlspecialchars( $_POST['mot_de_passe2']);

if ( !empty($_POST['mot_de_passe']) && !empty($_POST['mot_de_passe2']) && $_POST['mot_de_passe'] === $_POST['mot_de_passe2'] && !empty($_POST['email']) && !empty($_POST['prenom']) && !empty($_POST['nom'])){

    $password = password_hash($password,PASSWORD_BCRYPT);
    $dbrequete = $pdo->prepare("INSERT INTO users (nom,prenom,email,mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)");
    $dbrequete->execute(
        array(
            "nom"=> $nom,
            "prenom"=> $prenom,
            "email"=> $email,
            "mot_de_passe"=> $password,  
        )
        );
      
    }else {
           echo "les mots de passe ne sont pas identiques";
           }
    }
?>
<body>
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
    <div class="formulaire">
        <form action="inscription.php" method="POST">
            <h2>Créer un compte</h2><br>
            <div class="champs">
                <label class="titre">Nom</label><br>
                <input class="zone_de_texte" type="text" name="nom" id="Nom" value="" placeholder="Votre Nom"></input><br>
                <label class="titre">Prenom</label><br>
                <input class="zone_de_texte" type="text" name="prenom" id="prenom" value="" placeholder="Votre Prenom"></input><br>
                <label class="titre">Email</label><br>
                <input class="zone_de_texte" type="email" name="email" id="email" value="" placeholder="Votre Mail"></input><br>
                <label class="titre">Mot de passe</label><br>
                <input class="zone_de_texte" type="password" name="mot_de_passe" id="password" value=""></input><br>
                <label class="titre">Confirmation de Mot de passe</label><br>
                <input class="zone_de_texte" type="password" name="mot_de_passe2" id="password2" value=""></input><br>
                <input class="" type="submit" name="submit"></input>
            </div>    
        </form>
    </div>
</content>
</body>
</html>