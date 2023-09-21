
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage V.Parrot</title>
    <link href="style.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    
</head>
<?php
require("codb.php");

 function afficher(){
    if(require("codb.php")){
        $dbrequete = $pdo->prepare("SELECT * FROM new_voiture ORDER BY id DESC LIMIT 3");
        $dbrequete->execute();
        $data = $dbrequete->fetchALL(PDO::FETCH_OBJ);
        return $data;
        $dbrequete->closeCursor();
    }    
} 
$voitures = afficher();
?>

<?php
//fonction de filtre utile a l'affichage de l'article recherché
function filtrer(){
    if(isset($_POST['submit'])){ 
    $datesel = $_POST['dateRange'];
    $kilometresel = $_POST['kilometerRange'];
    $prixsel = $_POST['priceRange'];
    $marque = $_POST['marque'];
//Nous permet d'avoir l'affichage de tout les article au chargement initial de la page
    if(empty($marque)){
    $requete = ("SELECT * FROM new_voiture WHERE prix <=:prixsel AND kilometrage <=:kilometresel AND mise_en_circulation >= :datesel");
    }
    else{
        $requete = ("SELECT * FROM new_voiture WHERE marque = :marque AND prix <=:prixsel AND kilometrage <=:kilometresel AND mise_en_circulation >= :datesel ");
    }
//Nous permet de nous reconnecter a la bdd a chaques "cycles" tout en fermant l'accés a la fin de la requete
    if(require("codb.php")){
        $dbrequete = $pdo->prepare($requete);
    }

    if(!empty($marque)){
    $dbrequete->bindParam(":marque", $marque, PDO::PARAM_STR);
    $dbrequete->bindParam(":prixsel", $prixsel, PDO::PARAM_INT);
    $dbrequete->bindParam(":datesel", $datesel, PDO::PARAM_INT);
    $dbrequete->bindParam(":kilometresel", $kilometresel, PDO::PARAM_INT);
    
        $dbrequete->execute();
        $result = $dbrequete->fetchALL(PDO::FETCH_OBJ);
        return $result;
    }
}
return array();
$dbrequete->closeCursor();
}
$voituresFiltrees = filtrer();
?>
<body>
<content>
    <headers>
        <nav>
            <a href="index.php"><img class="logo" src="Ressources/ECF_logo.jpg"></img></a>
            <ul>
               
                </div>
                <li><a href="index.php" class="menunav">Achats d'occasion</a></li>
                <li><a href="contact.php" class="menunav">Ventes & Réparation</a></li>
                <li><a href="forum.php" class="menunav">Forum</a></li> 
                <li><a href="connexion.php" class="menunav">Connexion</a></li> 
            </ul>
         
            
        </nav>        
    </headers>
    
    <aside>
        <form action="index.php" method="POST">
            <datalist class="filter">
                <h3>Filtres</h3>
                <p>Prix</p>
                <input class=price-cursor type="range"  name="priceRange" id="priceRange" min="0" max="70000" value="10000" step="1000">
                <p id="priceDisplay">10000 €</p>
                <p>Kilomètrage</p>
                <input class="kilometer-cursor" type="range" name="kilometerRange" id="kilometerRange" min="0" max="500000" value="0" step="10000"></option></br>
                <p id="kilometerDisplay">0 Km</p>
                <p>Date de mise en circulation</p>
                <input class="date-cursor" type="range" name="dateRange" id="dateRange" min="1980" max="2023" value="2000" step="1"></option></br>
                <p id="dateDisplay">2001</p>
                
            
            <h3>Marques</h3>
            <select name="marque" id="list-auto">
                <option value="">Tous</option>
                <option value="toyota">TOYOTA</option>
                <option value="kia">KIA</option>
                <option value="bmw">BMW</option>
                <option value="tesla">TESLA</option>
                <option value="citroen">CITROEN</option>
                <option value="fiat">FIAT</option>
            </datalist>
            </select>
        
        <input class="brand_submit" type="submit" name="submit" value="Rechercher">
        </form>
    </aside>
  
    <div class="zoneaff">
        <?php 
    $voituresAafficher = empty($voituresFiltrees) ? $voitures : $voituresFiltrees;
    //appel dela fonction proportionné par le nombre de resultat de la requette
    foreach($voituresAafficher as $voiture):
    ?> 
        <div class="zone_vignette">
            <ul class="objet_voiture">
                <h3 class="vignette"><?= $voiture->marque?> <?= $voiture->modele?></h3>
                <img class="image_auto"src="uploads1/<?=$voiture->nom_image?>"></img>
                <li class="prix"><b>Prix : <?= $voiture ->prix ?> €</b></li>
                <li class="kilometrage">Kilometrage : <?= $voiture ->kilometrage?> Km</li>
                <li class="circu">Date de mise en circulation : <?= $voiture ->mise_en_circulation?></li><br>
                <a  href="contact.php"><li class="lien info">Cet article m'interresse</li></a>
            </ul>
        </div>
        <?php endforeach ?>
    </div>  
</content>
  <script src='script.js'></script> 
  <script>
const menu = document.querySelector(".menu-list");
const menuBtn = document.querySelector(".menu-btn");
const cancelBtn = document.querySelector(".cancel-btn");

menuBtn.onclick = ()=>{
    menu.classList.add("active");
    menuBtn.classList.add("hide");
}
cancelBtn.onclick = ()=>{
    menu.classList.remove("active");
    menuBtn.classList.remove("hide");
}
</script> 
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