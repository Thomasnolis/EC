# ECF_projet_garage-main

Pour l'execution en local:
On deplace le fichier ECF_projet_garage dans le fichier htdocs de xampp tout en lançant Apache et mysql au prealable.
on se connecte a PHPmyAdmin a l'aide de ses identifiant en local.

Pour créer un administrateur on va faire les commandes suivantes :

CREATE DATABASE ecf_garage


On appuie sur executer

Une fois dans la base de donnée on effectue :

CREATE TABLE user (
 
  nom varchar(255) NOT NULL,
  prenom varchar(255) NOT NULL,
  email varchar(255) NOT NULL UNIQUE,
  mot_de_passe varchat(255) NOT NULL
)

Le compte user aura le rôle admin lié à son email unique sur le site 
pour cela il faudra modifier la valeur de l'email:"Mnamikaze@konoha.fr" dans le fichier ""connexion.php"" ligne 30 
