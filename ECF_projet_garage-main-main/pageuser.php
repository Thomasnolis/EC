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
    <title>Page d'administration</title>
    <link href="style.css" rel="stylesheet"/>
    <link href="form.css" rel="stylesheet"/>
</head>
<?php

try{
    $pdo = new PDO('mysql:dbname=ecfgarage;host=localhost','root','');
}
catch(PDOException $e){
    echo "Error : ".$e->getMessage();
}

if (isset($_POST['submit'])) {

$marque = $_POST["marque"];
$modele = $_POST["modele"];
$prix = $_POST["prix"];
$kilometrage = $_POST["kilometrage"];
$image_name = $_FILES["image"]["name"];
$image_tmp_name = $_FILES["image"]["tmp_name"];
$image_error = $_FILES["image"]["error"];
$date_mise_en_circulation =$_POST["mise_en_circulation"];


if($image_error === 0 ) {
    $destination = "uploads1/".$image_name ; 
    move_uploaded_file($image_tmp_name, $destination);
    echo " L'image a bien été enregistrée";}
    else {
      echo " Il y a eu une erreur lors du téléchargement de l'image";
    }
    $dbrequete = $pdo->prepare("INSERT INTO new_voiture (marque,modele,prix,kilometrage,nom_image,mise_en_circulation) VALUES (:marque, :modele, :prix, :kilometrage, :image_name, :date_mise_en_circulation)");
    $dbrequete->execute(
        array(
            "marque"=> $marque,
            "modele"=> $modele,
            "prix"=> $prix,
            "kilometrage"=> $kilometrage,
            "image_name"=> $image_name,
            "date_mise_en_circulation"=>$date_mise_en_circulation,   
        )
    );
    $reponse = $dbrequete->fetchAll(PDO::FETCH_ASSOC);    
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
                <a href="traitement_contact.php"><li class="menunav">Traitement contact</li></a> 
                <a href="modoforum.php"><li class="menunav">Moderation du Forum</li></a> 
                <a href="Deconnexion.php"><li class="menunav">Déconnexion</li></a> 
            <ul>
        </nav>        
    </headers>
<content>
    <div class="gd-formulaire">
        <form action="pageadmin.php" method="POST" enctype="multipart/form-data">
            <div class="champs">
            <h2>Ajouter un véhicule</h2><br>
            <label class="titre">Marques</label>
            <input class="zone_de_texte" type="text" name="marque" id="marque" value="" placeholder="selectionnez une marque"></input>
            <label class="titre">Modèle</label>
            <input class="zone_de_texte" type="text" name="modele" id="modele" value="" placeholder="selectionnez un modèle"></input>
            <label class="titre">Prix</label>
            <input class="zone_de_texte" type="number" name="prix" id="prix" value="" placeholder="selectionnez un prix"></input>
            <label class="titre">Date de mise en circulation</label>
            <input class="zone_de_texte" type="number" name="mise_en_circulation" id="mise_en_circulation" value="" placeholder="selectionnez une date"></input>
            <label class="titre">Kilomètrage</label>
            <input class="zone_de_texte" type ="number" name="kilometrage" id="kilometrage" value="" placeholder="selectionnez un kilomètrage"></input>
            <label class="titre">Photo</label>
            <input class="zone_de_texte" type="file" name="image" id="image" accept="image/png, image/jpg , image/jpeg"></input><br>
            <button type="submit" name="submit" value="Validez">valider</input>
        </form>
    </div>
    </div>
</content>
</body>
</html>