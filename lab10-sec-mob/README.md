#  Lab 10 : Instrumentation Dynamique avec Frida (Android)

Ce dépôt documente mon analyse dynamique de l'application Android vulnérable **Diva** (Damn Insecure and Vulnerable App) en utilisant **Frida**. L'objectif est de démontrer l'interception et la modification du comportement de l'application en temps réel (Natif et Java).

---

##  1. Préparation de l'environnement

Pour commencer, j'ai mis en place l'environnement de travail sur ma machine hôte en installant les outils nécessaires (Python, pip, frida et frida-tools).

<img width="1586" height="991" alt="sec1" src="images/img-1.png" />


Avant de déployer le serveur Frida sur l'émulateur, il est crucial de connaître son architecture. J'ai utilisé la commande `adb shell getprop ro.product.cpu.abi` qui m'a confirmé que l'émulateur tourne sous **x86**.

<img width="662" height="41" alt="sec2" src="images/img-2.png" />


J'ai ensuite téléchargé la version correspondante de `frida-server` pour cette architecture.

<img width="622" height="138" alt="sec3" src="images/img-3.png" />


Le fichier a été poussé dans le répertoire temporaire de l'émulateur (`/data/local/tmp/`) en utilisant `adb push`.

<img width="1188" height="96" alt="sec4" src="images/img-4.png" />


Pour que le système Android autorise l'exécution de ce binaire, je lui ai attribué les droits d'exécution nécessaires avec la commande `chmod 755`.

<img width="762" height="55" alt="sec5" src="images/img-5.png" />


Le serveur Frida a ensuite été lancé directement depuis le shell de l'émulateur.

<img width="767" height="87" alt="sec6" src="images/img-6.png" />


Enfin, pour que mon PC puisse communiquer avec le serveur sur l'émulateur, j'ai configuré la redirection des ports (`adb forward`). La commande `frida-ps -U` m'a permis de lister les processus et de confirmer que la connexion était parfaitement établie.

<img width="851" height="550" alt="sec7" src="images/img-7.png" />


---

##  2. Validation des Injections (Hooking Basique)

Avant de chercher des vulnérabilités, j'ai validé la capacité de Frida à s'injecter dans l'application Diva au niveau Java. Le script `Hello.js` a retourné un succès (`Frida Java.perform OK`).

<img width="1000" height="305" alt="sec11" src="images/img-8.png" />


J'ai effectué la même validation pour la couche Native (C/C++) avec le script `hello_native.js`, confirmant que Frida pouvait s'attacher aux adresses mémoire de bas niveau.

<img width="1279" height="354" alt="pic14" src="images/img-9.png" />


Pour préparer des hooks plus avancés, j'ai exploré dynamiquement l'environnement avec la console interactive Frida, identifiant l'architecture exacte (`Process.arch`) et localisant l'adresse mémoire de la fonction native `connect` dans la bibliothèque `libc.so`.

<img width="1184" height="380" alt="pic15" src="images/img-10.png" />


---

##  3. Audit de la couche Native (Réseau & Fichiers)

L'analyse de la couche native permet de voir ce que l'application fait "sous le capot". J'ai commencé par intercepter les appels réseau avec un hook sur la fonction `connect`.

<img width="1312" height="361" alt="pic16" src="images/img-11.png" />

Pour aller plus loin dans l'analyse réseau, le script `hook_network.js` a été déployé pour cibler simultanément les fonctions d'envoi (`send`) et de réception (`recv`).

<img width="1178" height="420" alt="pic17" src="images/img-12.png" />


Ensuite, j'ai audité le système de fichiers. J'ai d'abord créé une version ciblée de `hook_file.js` pour surveiller la fonction `open`, avec un filtre n'affichant que les fichiers liés à l'application Diva pour éviter le bruit du système.

<img width="945" height="397" alt="pic18" src="images/img-13.png" />


Face aux spécificités des architectures modernes qui utilisent d'autres appels système, j'ai amélioré ce script en une version "Universelle" capable d'intercepter à la fois `open` et `openat`.

<img width="957" height="312" alt="pic19" src="images/img-14.png" />


---

##  4. Exploitation des Vulnérabilités (Insecure Data Storage)

C'est ici que l'audit révèle les failles critiques. Dans l'exercice de stockage non sécurisé de Diva, l'utilisateur est invité à sauvegarder des identifiants.

<img width="492" height="819" alt="sec13" src="images/img-15.png" />


Plutôt que de chercher le fichier sur le disque, j'ai injecté un script Java (`hook_prefs_write.js`) pour intercepter la méthode `putString` des SharedPreferences. Dès que le bouton "SAVE" est cliqué, le script capture les actions.

<img width="1110" height="278" alt="sec12" src="images/img-16.png" />


Le résultat est sans appel : les mots de passe et identifiants sont interceptés et affichés **en clair** dans la console au moment exact de leur enregistrement.

<img width="936" height="524" alt="pic20" src="images/img-17.png" />


J'ai répété cette méthodologie pour les bases de données SQLite. En interceptant `execSQL` et `rawQuery`, mon script a pu capturer les requêtes `CREATE TABLE` et surtout l'insertion (`INSERT INTO`) des identifiants non chiffrés.

<img width="938" height="431" alt="pic21" src="images/img-18.png" />


---

##  5. Surveillance Avancée et Évasion

Pour clôturer l'audit, j'ai vérifié si l'application tentait de se défendre contre l'analyse dynamique. J'ai déployé un script pour intercepter la fonction anti-débogage (`isDebuggerConnected`).

<img width="948" height="361" alt="pic22" src="images/img-19.png" />


Enfin, j'ai surveillé les appels système via `Runtime.exec()`. Cette technique est souvent utilisée par les applications pour lancer des commandes shell (comme chercher le binaire `su`) afin de détecter si l'appareil est rooté.

<img width="945" height="372" alt="pic23" src="images/img-20.png" />


##  Conclusion
L'utilisation de Frida prouve que même si une application masque ses données à l'écran, toute information manipulée en mémoire (SharedPreferences, requêtes SQLite) peut être interceptée si elle n'est pas correctement chiffrée (via l'Android Keystore par exemple) avant son traitement.

