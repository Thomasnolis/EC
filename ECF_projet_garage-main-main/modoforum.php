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

function aff_coms(){
    if(require("codb.php")){
        $dbrequete = $pdo->prepare("SELECT * FROM forum WHERE valide IS NULL ");
        $dbrequete->execute();
        $data = $dbrequete->fetchALL(PDO::FETCH_OBJ);
        return $data;
        $dbrequete->closeCursor();
    }    
} 
$coms = aff_coms();


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
        foreach($coms as $com):
   
        ?>
    <form action="modoforum.php" method="POST">    
        <div class="container">
            <div class="comment">
            <h2>Commentaires</h2>
            <ul>
                <li class=""><b><?= $com->nom ?> </b></li>
                <li class="">NOTE:<?= $com->note?> </li>
                <li class="">MASSAGE: <br><?= $com->message_client?></li><br>
            </ul>
            <input class="btn1" type="submit" name="valider"> Valider le commentaire</input>
            <input class="btn2" type="submit" name="invalider"> Invalider le commentaire</input>
        </div>
        <?php endforeach ?>
        </form>    
    </content>
    <?php
    if(isset($_POST["valider"])){
        if(require("codb.php")){
                $dbrequete = $pdo->prepare("UPDATE forum SET valide = 1 WHERE id = :id");
                $dbrequete->execute(array(":id" => $com->id));
                
            }
        }
    
            if(isset($_POST["invalider"])){
                if(require("codb.php")){
                $dbrequete = $pdo->prepare("UPDATE forum SET valide = 2 WHERE id = :id");
                $dbrequete->execute(array(":id" => $com->id));
                }
        }
        
    ?>
</body>
</html>