# LAB 11 : Bypass de la Détection Root Android avec Frida

## Présentation du lab

Ce lab a pour objectif de comprendre comment une application Android peut détecter un environnement rooté, puis comment Frida peut être utilisé dans un cadre pédagogique et autorisé pour contourner cette détection à l’aide de hooks Java.

Application utilisée :

- Nom : Uncrackable1
- Package : com.example.mstg.uncrackable1
- Outil principal : Frida
- Environnement : Android Emulator

Ce lab est réalisé uniquement dans un environnement contrôlé, à des fins d’apprentissage en sécurité des applications mobiles.

---

## Objectifs du lab

Les objectifs principaux sont :

- Comprendre le principe de détection root dans une application Android.
- Observer le blocage initial de l’application.
- Identifier le package Android avec Frida.
- Lancer un script Frida pour contourner la détection.
- Vérifier que l’application fonctionne après le bypass.

---


## 1. Page du lab

La première capture présente le titre du lab, ses objectifs et les différentes étapes à réaliser.

Le lab s’intitule :

LAB 11 : Bypass de la Détection de Root Android avec Frida

Il explique comment analyser une application Android qui détecte le root et comment utiliser Frida pour neutraliser cette détection dans un cadre sécurisé.

<img width="1441" height="1091" alt="pic1" src="images/img-1.png" />


---

## 2. Observation du comportement initial

Au lancement de l’application Uncrackable1 sur l’émulateur Android, l’application détecte que l’environnement est rooté.

Elle affiche le message suivant :

Root detected!
This is unacceptable. The app is now going to exit.

Ce message confirme que la protection anti-root est active et que l’application refuse de continuer son exécution.

<img width="497" height="794" alt="pic2" src="images/img-2.png" />


---

## 3. Identification du package avec Frida

Avant d’injecter un script Frida, il faut identifier le package exact de l’application cible.

La commande utilisée est :

frida-ps -Uai

Cette commande permet d’afficher la liste des applications installées et détectées sur l’émulateur Android.

Dans la liste, on repère l’application :

Nom : Uncrackable1  
Package : com.example.mstg.uncrackable1

<img width="1987" height="791" alt="pic3" src="images/img-3.png" />


---

## 4. Lancement du script Frida

Après avoir identifié le package, on lance l’application avec Frida en injectant le script de bypass.

Commande utilisée :

frida -U -f com.example.mstg.uncrackable1 -l E:\MGR\mobile\lab\bypass.js

Explication de la commande :

- frida : outil d’instrumentation dynamique.
- -U : connexion à l’émulateur ou appareil Android.
- -f : lancement de l’application cible.
- com.example.mstg.uncrackable1 : package de l’application.
- -l : chargement du script JavaScript.
- bypass.js : script Frida utilisé pour contourner la détection root.

Le terminal affiche ensuite que Frida est connecté à l’émulateur et que l’application est lancée.


<img width="1987" height="791" alt="pic3" src="images/img-4.png" />

---

## 5. Vérification après bypass

Après l’injection du script Frida, l’application est relancée.

Le message Root detected n’apparaît plus et l’interface principale de l’application reste accessible.

Cela confirme que le bypass de la détection root a fonctionné correctement.

<img width="469" height="793" alt="pic4" src="images/img-5.png" />


---

## Résultat obtenu

Avant le bypass :

- L’application détecte le root.
- Un message d’alerte s’affiche.
- L’application bloque l’utilisateur.

Après le bypass :

- L’application se lance correctement.
- Le message Root detected ne bloque plus l’exécution.
- L’utilisateur peut accéder à l’interface principale.

---

## Commandes utilisées

Commande pour identifier les applications :

frida-ps -Uai

Commande pour lancer le script Frida :

frida -U -f com.example.mstg.uncrackable1 -l E:\MGR\mobile\lab\bypass.js

---

## Conclusion

Ce lab montre comment Frida peut être utilisé pour analyser dynamiquement une application Android et contourner une détection root dans un environnement de test.

Il permet de mieux comprendre :

- les mécanismes de protection anti-root ;
- l’analyse dynamique d’une application Android ;
- le rôle des hooks Java avec Frida ;
- les limites des protections simples lorsqu’elles ne sont pas renforcées.

Ce travail reste strictement pédagogique et doit être réalisé uniquement sur des applications de test ou avec autorisation explicite.

---

## Remarque éthique

Les techniques présentées dans ce lab doivent être utilisées uniquement dans un cadre légal, pédagogique et défensif.

L’objectif est d’apprendre à analyser et renforcer la sécurité des applications mobiles.

