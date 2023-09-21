<?php
try{
    $pdo = new PDO('mysql:dbname=ecfgarage;host=localhost','root','');
}
catch(PDOException $e){
    echo "Error : ".$e->getMessage();
}
?>