
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="style.css" rel="stylesheet"/>
    <link href="form.css" rel="stylesheet"/>
</head>
<?php
$erreur="";
session_start();
require("codb.php");

if (isset($_POST['submit'])) {

    if (!empty($_POST["email"]) && !empty($_POST["mot_de_passe"])) {

        $email_utilisateur = htmlspecialchars($_POST["email"]);
        $mot_de_passe_utilisateur = htmlspecialchars($_POST["mot_de_passe"]);

        $verify = $pdo->prepare("SELECT * FROM users WHERE email = :email_utilisateur");
        $verify->bindValue(":email_utilisateur", $email_utilisateur, PDO::PARAM_STR);
        $verify->execute();

        $data = $verify->fetch(PDO::FETCH_ASSOC);

        if (!empty($data) && password_verify($mot_de_passe_utilisateur, $data["mot_de_passe"])) {
            if ($data['email'] === "Mnamikaze@konoha.fr") {
                $_SESSION['admin'] = $data['prenom'];
                header('Location: pageadmin.php');
            } else {
                $_SESSION['user'] = $data['prenom'];
                header('Location: pageuser.php');
            }
        } else {
            $erreur= "L'identifiant ou le mot de passe ne sont pas valides.";
        }
    }
}

?>
<body>
    
<headers>
        <nav>
        <a href="index.php"><img class="logo" src="Ressources/ECF_logo.jpg"></img></a>
            <ul>
                <a href="index.php"><li class="menunav">Achats d'occasion</li></a>
                <a href="contact.php"><li class="menunav">Ventes & Réparation</li></a>
                <a href="forum.php"><li class="menunav">Forum</li></a> 
                <a href="connexion.php"><li class="menunav">Connexion</li></a> 
            <ul>
        </nav>        
    </headers>
<content>
    <div class="pt-formulaire">
        <form action="connexion.php" method="POST">
            <h2>Connexion</h2><br>
            <div class="champs">               
                <label class="titre">Email</label><br>
                <input class="zone_de_texte" type="email" name="email" id="email" placeholder="Votre Mail"></input><br>
                <label class="titre">Mot de passe</label><br>
                <input class="zone_de_texte" type="password" name="mot_de_passe" id="password"></input><br>
                <input  type="submit" name="submit"></input>
                <h4><?php echo $erreur?></h4>
            </div>    
        </form>
    </div>
</content>
</body>
</html>
