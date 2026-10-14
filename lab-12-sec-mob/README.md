# LAB 12 : Bypass de la Détection Root Android avec Medusa

**Cours : Sécurité des Applications Mobiles**  
**Environnement : Windows / Android Emulator / ADB / Frida / Medusa**  

---

## 1. Objectif du Lab

L’objectif de ce lab est de réaliser un bypass de la détection root sur une application Android vulnérable à l’aide de l’outil **Medusa**, qui utilise **Frida** pour injecter des scripts dynamiquement dans l’application.

L’application utilisée détecte au départ que l’émulateur Android est rooté et affiche un message d’erreur. Après l’activation du module anti-root via Medusa, l’application ne détecte plus le root et devient utilisable normalement.

---


## 3. Pic1 — Installation et vérification de Frida

<img width="1645" height="552" alt="pic1" src="images/img-1.png" />


Cette capture montre la vérification de la version de Python avec la commande :

```powershell
python --version
```

Le résultat obtenu est :

```text
Python 3.13.0
```

Ensuite, Frida et Frida-tools sont installés ou mis à jour avec :

```powershell
pip install --upgrade frida frida-tools
```

Après l’installation, la version de Frida est vérifiée avec :

```powershell
frida --version
```

Le résultat affiché est :

```text
17.9.6
```

La version du module Frida utilisé par Python est aussi vérifiée avec :

```powershell
python -c "import frida; print(frida.__version__)"
```

Cela confirme que Frida est bien installé et prêt à être utilisé.

---

## 4. Pic2 — Vérification de ADB et connexion de l’émulateur

<img width="731" height="154" alt="pic2" src="images/img-2.png" />


Cette capture montre la vérification de ADB avec la commande :

```powershell
adb version
```

Le résultat indique que ADB est installé correctement :

```text
Android Debug Bridge version 1.0.41
```

Ensuite, la commande suivante permet de vérifier que l’émulateur Android est bien connecté :

```powershell
adb devices
```

Résultat obtenu :

```text
List of devices attached
emulator-5554    device
```

Cela confirme que l’émulateur Android est détecté et prêt pour le test.

---

## 5. Pic3 — Lancement de Medusa et sélection de l’application cible

<img width="731" height="154" alt="pic2" src="images/img-3.png" />

<img width="742" height="630" alt="pic3" src="images/img-4.png" />




Cette capture montre le lancement de Medusa sur l’application cible :

```powershell
python medusa.py -p jakhar.aseem.diva -d emulator-5554
```

Medusa détecte l’appareil Android connecté et affiche plusieurs informations système, comme :

```text
ro.product.manufacturer : Google
ro.build.version.release : 11
ro.build.version.sdk : 30
ro.build.tags : dev-keys
```

L’outil affiche également la liste des applications installées sur l’émulateur.  
L’application cible utilisée dans ce lab est :

```text
jakhar.aseem.diva
```

---

## 6. Pic4 — Injection du script anti-root avec Medusa

<img width="1206" height="451" alt="pic4" src="images/img-5.png" />

Cette capture montre que Medusa attache une session Frida au processus de l’application Android.

On remarque le message suivant :

```text
Attaching frida session to PID
```

Ensuite, Medusa charge le script de bypass de la détection root :

```text
LOADING ANTI ROOT DETECTION SCRIPT
```

Medusa affiche aussi les informations de l’application :

```text
Application Name : android.app.Application
Files Directory : /data/user/0/jakhar.aseem.diva/files
Cache Directory : /data/user/0/jakhar.aseem.diva/cache
Package Code Path : /data/app/.../base.apk
```

Cela confirme que Frida est attaché correctement à l’application et que le script de bypass est chargé.

---

## 7. Pic5 — Résultat avant le bypass : root détecté

<img width="359" height="778" alt="pic5" src="images/img-6.png" />


Cette capture montre l’état initial de l’application avant l’utilisation du bypass.

L’application affiche le message suivant :

```text
Root detected!
This is unacceptable. The app is now going to exit.
```

Cela signifie que l’application a détecté que l’appareil Android est rooté.  
À ce stade, l’application bloque son exécution normale.

---

## 8. Pic6 — Résultat après le bypass : application fonctionnelle

<img width="331" height="737" alt="pic6" src="images/img-7.png" />


Cette capture montre le résultat après l’activation du script anti-root avec Medusa.

Le message **Root detected** n’apparaît plus.  
L’application reste ouverte et l’utilisateur peut accéder à l’écran principal normalement.

Cela signifie que le bypass de la détection root a été effectué avec succès.

---

## 9. Étapes réalisées

Les étapes principales du lab sont les suivantes :

1. Vérification de l’installation de Python.
2. Installation et vérification de Frida et Frida-tools.
3. Vérification de ADB.
4. Connexion de l’émulateur Android.
5. Lancement de l’application vulnérable.
6. Observation de la détection root.
7. Lancement de Medusa.
8. Sélection de l’application cible.
9. Injection du script anti-root.
10. Validation du bypass.

---

## 10. Commandes utilisées

### Vérifier Python

```powershell
python --version
```

### Installer Frida et Frida-tools

```powershell
pip install --upgrade frida frida-tools
```

### Vérifier la version de Frida

```powershell
frida --version
```

### Vérifier Frida avec Python

```powershell
python -c "import frida; print(frida.__version__)"
```

### Vérifier ADB

```powershell
adb version
```

### Vérifier les appareils connectés

```powershell
adb devices
```

### Lancer Medusa sur l’application cible

```powershell
python medusa.py -p jakhar.aseem.diva -d emulator-5554
```

---

## 11. Résultat obtenu

Avant le bypass :

```text
L’application détecte le root et affiche une alerte.
```

Après le bypass :

```text
L’application ne détecte plus le root et fonctionne normalement.
```

Le bypass est donc validé avec succès.

---

## 12. Conclusion

Ce lab a permis de comprendre comment une application Android peut détecter un environnement rooté et comment un outil d’instrumentation dynamique comme Medusa, basé sur Frida, peut être utilisé dans un cadre pédagogique pour contourner cette détection.

L’environnement a été préparé avec Python, ADB, Frida et Medusa.  
L’application cible a d’abord détecté le root, puis le script anti-root a été injecté avec succès.  
Après l’injection, l’application est devenue accessible sans afficher l’alerte de détection root.

---

## 13. Remarque éthique

Ce travail est réalisé uniquement dans un cadre pédagogique et dans un environnement de laboratoire autorisé.  
Les techniques utilisées doivent être appliquées uniquement sur des applications de test, des environnements personnels ou dans le cadre d’un audit légal avec autorisation.

