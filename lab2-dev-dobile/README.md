# Application Android — Calcul des impôts locaux

Cette application Android permet de calculer le montant total des impôts locaux en fonction de :

* la **surface** de la maison (en m²)
* le **nombre de pièces**
* la **présence ou non d’une piscine**

## Fonctionnement

L’utilisateur saisit :

* la surface
* le nombre de pièces
* coche la case **Piscine** si la maison possède une piscine

Ensuite, en cliquant sur le bouton **Calculer**, l’application affiche :

* **Impôt de base**
* **Impôt supplémentaire**
* **Impôt total**

## Formule utilisée

* **Impôt de base** = surface × 2
* **Impôt supplémentaire** = (nombre de pièces × 50) + 100 si piscine
* **Impôt total** = impôt de base + impôt supplémentaire

## Exemple de test

Pour les valeurs suivantes :

* Surface = **100 m²**
* Nombre de pièces = **3**
* Piscine = **Non cochée**

Le résultat affiché est :

* Impôt de base : **200.0 DH**
* Impôt supplémentaire : **150 DH**
* Impôt Total : **350.0 DH**

## Captures d’écran

### Écran 1 — Formulaire de saisie

<img width="578" height="615" alt="pic1" src="images/img-1.png" />


Cet écran permet à l’utilisateur d’entrer les informations nécessaires :

* surface
* nombre de pièces
* présence d’une piscine

### Écran 2 — Résultat du calcul

<img width="278" height="535" alt="pic2" src="images/img-2.png" />

Après avoir cliqué sur **Calculer**, l’application affiche le détail du calcul :

* impôt de base
* impôt supplémentaire
* impôt total

## Technologies utilisées

* **Android Studio**
* **Kotlin**
* **XML** pour l’interface utilisateur

## Objectif du TP

Ce mini projet a pour objectif de pratiquer :

* la création d’une interface Android avec XML
* la récupération des données saisies
* la gestion des événements avec un bouton
* l’affichage dynamique d’un résultat
* l’utilisation de calculs simples en Kotlin

