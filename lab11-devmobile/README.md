#  LocalisationSmartphone + PHP/MySQL

##  Présentation

Ce mini-projet met en place une communication entre une application Android et un serveur PHP local afin de récupérer la position du smartphone, puis l’enregistrer dans une base de données MySQL via phpMyAdmin.

L’application :
- demande l’autorisation d’accéder à la localisation ;
- récupère la latitude, la longitude, la date et l’identifiant IMEI ;
- envoie les données vers un script PHP ;
- stocke les informations dans la table `position` de la base `localisation`.

---

##  Objectif du projet

L’objectif principal est de montrer un exemple simple de liaison entre :

- **Android Studio** pour la partie mobile,
- **PHP** pour le traitement côté serveur,
- **MySQL / phpMyAdmin** pour la persistance des données.

Ce projet illustre donc un cas pratique de **géolocalisation mobile connectée à une base de données**.

---

##  Technologies utilisées

- **Java**
- **Android Studio**
- **PHP**
- **MySQL**
- **phpMyAdmin**
- **XAMPP**
- **Emulateur Pixel 5**

---

##  Organisation du projet

Le dossier serveur contient les fichiers nécessaires au traitement et à l’insertion des données côté PHP.




<img width="1558" height="355" alt="image" src="images/img-1.png" />



---

##  Fonctionnement global

Le fonctionnement de l’application se déroule en plusieurs étapes :

1. L’utilisateur lance l’application Android.
2. Une demande d’autorisation de localisation apparaît.
3. Après validation, l’application récupère les coordonnées GPS.
4. Les données sont envoyées au script `createPosition.php`.
5. Le script PHP insère les informations dans la table `position`.
6. Le résultat est vérifié dans **phpMyAdmin**.

---

##  Demande d’autorisation

Au démarrage, l’application affiche une boîte de dialogue demandant l’accès à la localisation du téléphone.




<img width="382" height="739" alt="image" src="images/img-2.png" />


---

##  Résultat affiché dans l’application

Une fois la permission accordée, l’application affiche les informations récupérées :
- latitude,
- longitude,
- date,
- IMEI.



<img width="366" height="737" alt="image" src="images/img-3.png" />


<img width="1433" height="936" alt="image" src="images/img-4.png" />


<img width="1437" height="937" alt="image" src="images/img-5.png" />



---

##  Vérification dans la base de données

Après l’envoi depuis Android, les données sont bien enregistrées dans la table `position` de la base `localisation`.




<img width="501" height="223" alt="image" src="images/img-6.png" />


---

##  Étapes d’exécution

### 1. Démarrer le serveur local
Lancer **XAMPP** et activer :
- **Apache**
- **MySQL**

### 2. Créer la base de données
Dans phpMyAdmin :
- créer la base `localisation`
- créer la table `position`

### 3. Placer le dossier PHP
Copier le dossier du projet dans :

`C:\xampp\htdocs\localisation`

### 4. Tester le script PHP
Ouvrir dans le navigateur :

`http://localhost/localisation/createPosition.php`

### 5. Lancer l’application Android
Exécuter l’application sur l’émulateur **Pixel 5**.

### 6. Autoriser la localisation
Cliquer sur **While using the app**.

### 7. Vérifier l’insertion
Contrôler dans **phpMyAdmin** que la ligne a bien été ajoutée dans la table `position`.

---

##  Résultat final

À la fin de l’exécution :

- l’application mobile récupère la position ;
- les informations s’affichent correctement ;
- les données sont transmises au serveur PHP ;
- l’insertion dans MySQL est réussie.



---


