<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modération Forum</title>
    <link href="form.css" rel="stylesheet"/>
    <link href="style.css" rel="stylesheet"/>
</head>
<?php
require("codb.php");

function aff_contacts(){
    if(require("codb.php")){
        $dbrequete = $pdo->prepare("SELECT * FROM contact WHERE traite IS NULL ");
        $dbrequete->execute();
        $data = $dbrequete->fetchALL(PDO::FETCH_OBJ);
        return $data;
        $dbrequete->closeCursor();
    }    
} 
$contacts = aff_contacts();


?>
<body>
    <headers>
        <nav>
            <a href="index.php"><img class="logo" src="Ressources/ECF_logo.jpg"></img></a>
            <ul> 
                <a href="contact.php"><li class="menunav">Ventes & Réparation</li></a>
                <a href="forum.php"><li class="menunav">Forum</li></a> 
                <a href="modoforum.php"><li class="menunav">Modération forum</li></a> 
                <a href="Deconnexion.php"><li class="menunav">Déconnexion</li></a> 
            <ul>
        </nav>        
    </headers>
    <content>
        <?php
        foreach($contacts as $contact):
   
        ?>
    <form action="traitement_contact.php" method="POST">    
        <div class="container">
            <div class="comment">
            <h2>Commentaires</h2>
            <ul>
                <li class=""><b>NOM : <?= $contact->nom ?> </b></li>
                <li class="">PRENOM :<?= $contact->prenom?> </li>
                <li class="">EMAIL : <?= $contact->email?> </li>
                <li class="">NUMERO :<?= $contact->numero?> </li>
                <li class="">MASSAGE : <br><?= $contact->message_client?></li><br>
            </ul>
            <input class="btn1" type="submit" name="valider"> Valider le traitement</input>
            <input class="btn2" type="submit" name="invalider"> Invalider le traitement</input>
        </div>
        <?php endforeach ?>
        </form>    
    </content>
    <?php
    if(isset($_POST["valider"])){
        if(require("codb.php")){
                $dbrequete = $pdo->prepare("UPDATE contact SET valide = 1 WHERE id = :id");
                $dbrequete->execute(array(":id" => $contact->id));
                
            }
        }
    
            if(isset($_POST["invalider"])){
                if(require("codb.php")){
                $dbrequete = $pdo->prepare("UPDATE contact SET valide = 2 WHERE id = :id");
                $dbrequete->execute(array(":id" => $contant->id));
                }
        }
        
    ?>
</body>
</html>