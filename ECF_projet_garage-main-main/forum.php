<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link href="style.css" rel="stylesheet"/>
    <link href="form.css" rel="stylesheet"/>
</head>
<body>
    <?php
    require("codb.php");
    if(isset($_POST["submit"])){
        $nom = htmlspecialchars($_POST["nom"]);
        $message_client = htmlspecialchars($_POST["message_client"]);
        $note = $_POST["note"];
        if (require("codb.php")){
            $dbrequete = $pdo ->prepare("INSERT INTO forum (nom,message_client,note) Values (:nom,:message_client,:note)");
            $dbrequete->execute(array(
                "nom"=> $nom,
                "message_client"=> $message_client,
                "note"=>$note
            ));
        }
    }

    function aff_coms(){
        if(require("codb.php")){
            $dbrequete = $pdo->prepare("SELECT * FROM forum WHERE valide = 1 ");
            $dbrequete->execute();
            $data = $dbrequete->fetchAll(PDO::FETCH_OBJ);
            $dbrequete->closeCursor();
            return $data;
        }    
    } 
    $coms = aff_coms();
    ?>

    <header>
        <nav>
            <a href="index.php"><img class="logo" src="Ressources/ECF_logo.jpg" alt="Logo"></a>
            <ul>
                <a href="index.php"><li class="menunav">Achats d'occasion</li></a>
                <a href="contact.php"><li class="menunav">Ventes & Réparation</li></a>
                <a href="forum.php"><li class="menunav">Forum</li></a> 
                <a href="connexion.php"><li class="menunav">Connexion</li></a> 
            </ul>
        </nav>        
    </header>

    <content>
        <div class="formulaire">
            <form action="forum.php" method="POST">
                <h2>Laissez nous votre avis !</h2><br>
                <div class="champs">
                    <label class="titre">Laissez votre nom</label><br>
                    <input class="zone_de_texte" type="text" name="nom" id="Nom" value="" placeholder="Votre Nom"></input><br>
                    <h3>Laissez votre commentaire</h3>
                    <textarea class="zone_de_com" name="message_client" rows="10" cols="40"></textarea>
                    <h3>Votre note</h3>
                    <select name="note" >
                        <option value="0">--Choisissez une Note--</option>
                        <option value="1">1 étoile</option>
                        <option value="2">2 étoiles</option>
                        <option value="3">3 étoiles</option>
                        <option value="4">4 étoiles</option>
                        <option value="5">5 étoiles</option>
                    </select>
                    <input class="" type="submit" name="submit"></input>
                </div>    
            </form>
        </div>
       
        
       
        <?php foreach($coms as $com): ?>
        <div class="container">
            <div class="comment">
                <ul>
                    <li class=""><b><?= $com->nom ?> </b></li>
                    <li class="">NOTE:<?= $com->note?> </li>
                    <li class="">MESSAGE: <br><?= $com->message_client?></li><br>
                </ul>
            </div>
        </div>
        <?php endforeach ?>
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
</body>
</html>
