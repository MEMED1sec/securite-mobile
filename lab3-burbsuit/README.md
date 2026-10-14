# README — Configuration de Burp Suite avec Android Emulator

## Objectif du lab

L’objectif de ce lab est de configurer **Burp Suite** comme proxy d’analyse afin d’observer le trafic réseau provenant d’un **Android Emulator**.  
Le travail consiste à :

- préparer Burp Suite
- identifier l’adresse IP de la machine hôte
- configurer le proxy dans l’émulateur Android
- vérifier l’apparition des requêtes dans **HTTP history**
- analyser une requête capturée
- tester l’interception avec **Intercept**

## Environnement utilisé

- **Burp Suite Community Edition**
- **Android Emulator**
- **Windows**
- **Port proxy utilisé :** `8080`
- **Adresse IP de la machine hôte :** `192.168.11.101`

## Étape 1 — Vérification de l’état initial d’Intercept

Au début du lab, Burp Suite a été lancé puis l’onglet **Proxy > Intercept** a été vérifié.  
L’interception a été laissée désactivée afin de ne pas bloquer immédiatement le trafic. Cette étape est importante, car elle permet d’observer le trafic dans **HTTP history** avant de passer au mode d’interception active.

<img width="1600" height="896" alt="b0" src="images/img-1.png" />

## Étape 2 — Vérification du Proxy Listener dans Burp

La configuration du listener Burp a ensuite été vérifiée dans **Proxy settings**.  
Au début, Burp écoutait sur `127.0.0.1:8080`, ce qui signifie que le proxy était limité à l’interface locale. Cette configuration peut poser problème lorsque l’émulateur doit joindre Burp depuis le réseau virtuel.

Cette étape a permis d’identifier le listener actif ainsi que le port utilisé par Burp.

<img width="1343" height="890" alt="b1" src="images/img-2.png" />

## Étape 3 — Identification de l’adresse IP de la machine hôte

Pour que l’émulateur Android puisse envoyer son trafic vers Burp, il a fallu identifier l’adresse IPv4 de la machine hôte.  
La commande `ipconfig` a permis de récupérer l’adresse active de l’interface réseau principale.

L’adresse retenue pour le lab est :

```text
192.168.11.101
```

Cette adresse a ensuite été utilisée comme **Proxy hostname** dans la configuration réseau de l’émulateur.

<img width="776" height="182" alt="b2" src="images/img-3.png" />

## Étape 4 — Configuration du proxy dans Android Emulator

Une fois l’adresse IP de la machine hôte identifiée, le proxy a été configuré dans l’émulateur Android.  
Le mode **Manual** a été choisi et les valeurs suivantes ont été renseignées :

- **Proxy hostname :** `192.168.11.101`
- **Proxy port :** `8080`

Cette étape est essentielle, car elle permet au navigateur de l’émulateur d’envoyer ses requêtes à Burp Suite au lieu de sortir directement vers Internet.

<img width="319" height="492" alt="b3" src="images/img-4.png" />

> **Remarque :** Le champ **Bypass proxy for** peut empêcher certains domaines de passer par Burp s’il contient des exceptions. Pendant les tests, il est préférable de le laisser vide ou de vérifier qu’il ne contourne pas la cible testée.

## Étape 5 — Problème rencontré lors du test initial

Lors des premiers essais, une erreur de saisie a été rencontrée dans le navigateur de l’émulateur.  
Le site demandé n’a pas répondu, ce qui a empêché de valider immédiatement la capture du trafic. Cette étape fait partie des difficultés rencontrées durant le lab et montre l’importance de vérifier l’adresse testée.

<img width="276" height="511" alt="b4" src="images/img-5.png" />

Au cours des essais, une adresse incorrecte a été saisie dans le navigateur, ce qui a provoqué un échec de connexion. Cette erreur a été corrigée par la suite afin de poursuivre la validation du proxy.

## Étape 6 — Validation de la capture dans HTTP history

Après correction de la configuration et des tests, Burp a commencé à afficher les requêtes capturées dans **HTTP history**.  
Cette étape confirme que le trafic de l’émulateur transite bien par le proxy Burp.

On observe dans l’historique plusieurs requêtes vers différents hôtes, ce qui valide le bon fonctionnement de la chaîne de capture.

<img width="1559" height="484" alt="b5" src="images/img-6.png" />

## Étape 7 — Analyse d’une requête capturée

Une fois les requêtes visibles dans l’historique, une requête a été sélectionnée afin d’en examiner le détail.  
L’analyse permet d’observer :

- la méthode HTTP utilisée
- l’hôte visé
- les en-têtes de la requête
- les en-têtes de la réponse
- les éventuels cookies
- le code de statut retourné

Cette étape montre comment Burp peut être utilisé pour lire et comprendre le trafic généré par une application ou un navigateur mobile.

<img width="1596" height="869" alt="b6" src="images/img-7.png" />

La requête sélectionnée met en évidence la structure complète de l’échange HTTP/HTTPS, avec les headers côté requête et réponse, ainsi que plusieurs cookies retournés par le serveur.

## Étape 8 — Test d’interception avec Intercept

Après validation de la capture passive, l’interception active a été testée dans l’onglet **Intercept**.  
Le mode **Intercept on** a été activé, ce qui a permis de bloquer temporairement une requête avant son envoi au serveur.

Cette étape permet de comprendre la différence entre :

- **HTTP history** : observation passive
- **Intercept** : arrêt temporaire et contrôle actif des requêtes

<img width="1602" height="418" alt="b7" src="images/img-8.png" />

## Résultat obtenu

À la fin du lab, Burp Suite a été correctement configuré comme proxy d’analyse pour l’Android Emulator.  
Les résultats obtenus montrent que :

- le proxy Burp fonctionne sur le port `8080`
- l’émulateur Android est capable d’envoyer son trafic vers Burp
- les requêtes apparaissent dans **HTTP history**
- il est possible de lire les détails d’une requête capturée
- l’interception active fonctionne dans l’onglet **Intercept**

## Conclusion

Ce lab a permis de mettre en place un environnement d’analyse réseau simple entre **Android Emulator** et **Burp Suite**.  
Il montre concrètement comment configurer un proxy, observer des requêtes HTTP/HTTPS, analyser leur contenu et utiliser l’interception pour un contrôle plus précis du trafic.

Cette manipulation constitue une base importante pour les travaux de sécurité mobile, de débogage réseau et d’analyse du comportement applicatif.

