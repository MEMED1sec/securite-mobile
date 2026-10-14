# Projet Lab 9 — Application Android connectée à un Web Service PHP

## Description du projet

Ce projet a pour objectif de réaliser une application Android permettant de gérer des étudiants à travers un Web Service développé en PHP.

L’application Android envoie les données saisies par l’utilisateur vers un serveur local PHP.  
Le serveur PHP reçoit les données, communique avec la base MySQL, puis retourne une réponse au format JSON.

Ce projet permet donc de pratiquer la liaison entre :

- une application mobile Android ;
- un Web Service PHP ;
- une base de données MySQL ;
- un outil de test REST.

---

## Technologies utilisées

Les technologies utilisées dans ce projet sont :

- PHP
- MySQL
- phpMyAdmin
- XAMPP
- Android Studio
- Java
- Volley
- Gson
- Advanced REST Client

---



## 1. Préparation de la base de données

La première partie du projet consiste à créer une base de données MySQL à l’aide de phpMyAdmin.

La table utilisée s’appelle :

    etudiant

Elle contient les colonnes suivantes :

    id
    nom
    prenom
    ville
    sexe

Capture utilisée :

<img width="1180" height="398" alt="image" src="images/img-1.png" />


Cette image montre le contenu de la table etudiant dans phpMyAdmin.  
Elle permet de vérifier que les enregistrements sont bien sauvegardés dans la base.

---

## 2. Création d’un nouveau projet PHP

La deuxième étape consiste à créer un projet PHP dans l’environnement de développement.

Capture utilisée :

<img width="775" height="584" alt="image" src="images/img-2.png" />

Dans la fenêtre de création du projet, on choisit :

    PHP Project

Puis on passe à l’étape suivante.

---

## 3. Définition du nom et du chemin du projet

Le projet est nommé :

    lab9_dev

Son emplacement est :

    C:\xampp\htdocs\lab9_dev

Capture utilisée :

<img width="798" height="598" alt="image" src="images/img-3.png" />


Le dossier htdocs est obligatoire, car il représente le dossier racine du serveur Apache dans XAMPP.

Ainsi, le projet sera accessible avec l’adresse suivante :

    http://localhost/lab9/

---

## 4. Organisation initiale du projet

Après la création du projet, les dossiers de base sont créés.

Capture utilisée :

<img width="391" height="455" alt="image" src="images/img-4.png" />


La structure contient les dossiers suivants :

    classes
    connexion
    controller
    dao
    service
    ws

Cette organisation permet de séparer les différentes parties du projet.

---

## 5. Organisation finale avec les fichiers PHP

Après l’ajout des fichiers PHP, l’arborescence du projet devient complète.

Capture utilisée :

<img width="460" height="561" alt="image" src="images/img-5.png" />


Les fichiers importants sont :

    Etudiant.php
    Connexion.php
    IDao.php
    EtudiantService.php
    index.php
    racine.php

Explication des fichiers :

    Etudiant.php
    Ce fichier représente la classe étudiant avec ses attributs.

    Connexion.php
    Ce fichier permet d’établir la connexion entre PHP et MySQL.

    IDao.php
    Ce fichier définit les méthodes principales comme create, update, delete et findAll.

    EtudiantService.php
    Ce fichier contient la logique principale pour manipuler les étudiants.

    index.php
    Ce fichier peut être utilisé comme point d’entrée du projet.

    racine.php
    Ce fichier peut être utilisé pour gérer les chemins du projet.

---

## 6. Test du Web Service

Avant de passer à Android, il faut tester le Web Service avec Advanced REST Client.

Capture utilisée :

<img width="622" height="477" alt="image" src="images/img-6.png" />


Cet outil permet de tester les requêtes HTTP.

Exemple de service à tester :

    http://localhost/lab9/ws/loadEtudiant.php

La méthode utilisée pour afficher les étudiants est :

    GET

La méthode utilisée pour ajouter un étudiant est :

    POST

---

## 7. Affichage de la réponse JSON

Lorsque le Web Service fonctionne correctement, il affiche une réponse JSON.

Capture utilisée :

<img width="360" height="550" alt="image" src="images/img-7.png" />


---

## 8. Application Android

La dernière partie du projet consiste à créer une application Android.

Capture utilisée :

<img width="268" height="544" alt="image" src="images/img-8.png" />


L’application contient un formulaire avec :

    Nom
    Prénom
    Ville
    Sexe
    Bouton ADD

Après avoir rempli le formulaire, l’utilisateur clique sur ADD.  
L’application envoie alors les données vers le Web Service PHP grâce à Volley.

---

## 9. Communication entre Android et PHP

La communication se fait selon ce schéma :

    1. L’utilisateur remplit le formulaire Android
    2. L’application prépare une requête HTTP
    3. Volley envoie la requête vers PHP
    4. PHP reçoit les données
    5. PHP utilise PDO pour communiquer avec MySQL
    6. MySQL enregistre ou retourne les informations
    7. PHP renvoie une réponse JSON
    8. Android récupère la réponse

---

## 10. Configuration importante pour Android

Depuis un navigateur sur le PC, on peut utiliser :

    http://localhost/lab9/ws/loadEtudiant.php

Mais depuis l’émulateur Android, il ne faut pas utiliser localhost.

Il faut utiliser :

    http://10.0.2.2/lab9/ws/loadEtudiant.php

L’adresse 10.0.2.2 permet à l’émulateur Android d’accéder au serveur local du PC.

---

## 11. Résultat obtenu

Le projet final permet :

- d’ajouter un étudiant depuis Android ;
- d’envoyer les données vers PHP ;
- d’insérer les données dans MySQL ;
- de récupérer les étudiants au format JSON ;
- de tester les services avec Advanced REST Client ;
- de vérifier les données dans phpMyAdmin.

---

## Conclusion

Ce projet montre comment connecter une application Android à un Web Service PHP local.  
Il permet de comprendre le rôle de Volley, Gson, PHP, MySQL et phpMyAdmin dans une architecture simple client-serveur.

