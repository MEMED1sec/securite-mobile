Android : Désactivation du SSL Pinning avec Objection + Proxy

**Cours : Sécurité des applications mobiles**  
**Thème : Analyse HTTPS Android avec Frida, Objection et ADB**

---

## 1. Objectif du lab

Ce lab a pour objectif de comprendre comment analyser le trafic HTTPS d’une application Android dans un environnement contrôlé, en utilisant des outils de test de sécurité mobile comme **Frida**, **Frida-tools**, **Objection**, **ADB** et un proxy d’interception comme **Burp Suite** ou **mitmproxy**.

L’objectif principal est de préparer l’environnement, vérifier les outils installés, identifier l’application cible, lancer Objection et exécuter la commande permettant de désactiver le SSL Pinning dans un cadre pédagogique et autorisé.

---

## 2. Avertissement éthique

Ce lab doit être réalisé uniquement dans un cadre légal et autorisé, sur une application de test, un appareil personnel ou un environnement de laboratoire.

La désactivation du SSL Pinning sert ici à analyser le comportement réseau d’une application Android dans un contexte de formation en cybersécurité. Elle ne doit jamais être utilisée sur des applications ou systèmes sans autorisation.

---

## 3. Outils utilisés

- Windows PowerShell
- Python / pip
- Frida
- Frida-tools
- Objection
- Android Debug Bridge : ADB
- Android Platform-tools
- Émulateur Android ou appareil Android de test
- Application cible : `com.pwsec.firestorm`
- Proxy HTTPS : Burp Suite ou mitmproxy

---




Cette capture présente la page principale du lab intitulé :

**LAB 16 : Inspection HTTPS Android — Désactivation du SSL Pinning avec Objection + Proxy**

Elle montre les différentes étapes du lab, notamment :

- l’avertissement éthique ;
- les objectifs du lab ;
- les prérequis ;
- l’installation de Frida et Objection ;
- la configuration du proxy ;
- le lancement de l’application ;
- la validation finale.

---

## 6. Installation et vérification de Frida

<img width="1931" height="814" alt="pic1" src="images/img-1.png" />


Dans cette étape, Frida et Frida-tools sont installés ou mis à jour à l’aide de la commande suivante :

    pip install --upgrade frida frida-tools

La capture montre que Frida est installé correctement.

La version de Frida est ensuite vérifiée avec :

    frida --version

Résultat obtenu :

    17.9.6

Une deuxième vérification est réalisée directement avec Python :

    python -c "import frida; print(frida.__version__)"

Résultat obtenu :

    17.9.6

Cette étape confirme que Frida est bien installé et accessible depuis le terminal.

---

## 7. Vérification de l’installation d’Objection

<img width="1363" height="1154" alt="pic2" src="images/img-2.png" />


La commande suivante permet de vérifier que l’outil Objection est correctement installé :

    objection --help

Cette commande affiche l’aide d’Objection avec les options disponibles, comme :

- `--network`
- `--host`
- `--port`
- `--debug`
- `--spawn`
- `--no-pause`
- `--help`

Elle affiche aussi les commandes disponibles, notamment :

- `api`
- `patchapk`
- `patchipa`
- `run`
- `signapk`
- `start`
- `version`

La version d’Objection est ensuite vérifiée avec :

    objection version

Résultat obtenu :

    objection: 1.12.4

Cette étape confirme que Objection est installé et fonctionnel.

---

## 8. Lancement d’Objection avec désactivation du SSL Pinning

<img width="1547" height="488" alt="pic3" src="images/img-3.png" />

Dans cette étape, Objection est lancé sur l’application Android cible :

    com.pwsec.firestorm

La commande exécutée est :

    objection -g com.pwsec.firestorm explore --startup-command "android sslpinning disable"

Cette commande lance Objection sur l’application cible et exécute automatiquement la commande :

    android sslpinning disable

La sortie du terminal montre que Objection détecte et surcharge certains mécanismes liés au TrustManager Android :

    Custom TrustManager ready, overriding SSLContext.init()
    Found com.android.org.conscrypt.TrustManagerImpl, overriding TrustManagerImpl.verifyChain()
    Found com.android.org.conscrypt.TrustManagerImpl, overriding TrustManagerImpl.checkTrustedRecursive()

Ensuite, Objection enregistre un job :

    Registering job 372270. Name: android-sslpinning-disable

Cela indique que la commande de désactivation du SSL Pinning a été exécutée dans la session Objection.

---

## 9. Confirmation dans la session Objection
<img width="822" height="83" alt="pic4" src="images/img-4.png" />

Cette capture montre que la session Objection est active sur l’application :

    com.pwsec.firestorm

L’environnement Android détecté est :

    Android 11

La commande liée au SSL Pinning est exécutée dans la session Objection et un job est enregistré :

    Registering job 68691. Name: android-sslpinning-disable

Cette étape confirme que l’outil Objection est bien attaché à l’application cible et que la commande de désactivation du SSL Pinning est active.

---

## 10. Listing des packages Android avec ADB

<img width="1752" height="897" alt="pic5" src="images/img-5.png" />

Pour vérifier les applications installées sur l’appareil ou l’émulateur Android, la commande suivante est utilisée :

    adb shell pm list packages

Cette commande affiche la liste des packages Android installés.

Exemples de packages affichés :

    package:com.google.android.networkstack.tethering
    package:com.android.cts.priv.ctsshim
    package:com.google.android.youtube
    package:com.android.providers.telephony
    package:com.android.providers.media
    package:com.android.externalstorage

Cette étape est utile pour identifier le nom exact du package de l’application cible avant de lancer Objection.

---

## 11. Résultats obtenus

À la fin du lab, les éléments suivants ont été validés :

- Frida est installé correctement.
- Frida-tools est disponible dans le terminal.
- La version de Frida est vérifiée.
- Objection est installé correctement.
- La version d’Objection est vérifiée.
- L’application cible `com.pwsec.firestorm` est identifiée.
- Objection est lancé sur l’application Android cible.
- La commande `android sslpinning disable` est exécutée.
- Le job `android-sslpinning-disable` est enregistré.
- ADB permet de lister les packages Android installés.

---

## 12. Interprétation

Le lab montre comment utiliser Frida et Objection pour effectuer une analyse dynamique d’une application Android.

La désactivation du SSL Pinning permet, dans un environnement autorisé, de faciliter l’inspection du trafic HTTPS avec un proxy comme Burp Suite ou mitmproxy.

Cela permet de mieux comprendre :

- le comportement réseau d’une application Android ;
- les mécanismes de protection HTTPS ;
- la validation des certificats ;
- la configuration du SSL Pinning ;
- l’importance des tests de sécurité mobile.

---

## 13. Tableau récapitulatif des captures

| Capture | Description |
|---|---|
| `pic1.png` | Installation et vérification de Frida |
| `pic2.png` | Vérification de l’aide et de la version d’Objection |
| `pic3.png` | Lancement d’Objection avec désactivation du SSL Pinning |
| `pic4.png` | Confirmation dans la session Objection |
| `pic5.png` | Listing des packages Android avec ADB |
| `pic6.png` | Page principale du lab |

---

## 14. Conclusion

Ce lab a permis de mettre en place un environnement de test pour l’inspection HTTPS d’une application Android.

Les outils Frida, Frida-tools, Objection et ADB ont été utilisés pour vérifier l’environnement, identifier l’application cible et exécuter une commande permettant de désactiver le SSL Pinning dans un cadre de laboratoire.

Le lab a été réalisé avec succès par **Hamdi Maroua**.

---

## 15. Auteur


**Lab :** LAB 16 — Inspection HTTPS Android  
**Sujet :** Désactivation du SSL Pinning avec Objection + Proxy  
**Cours :** Sécurité des applications mobiles  
**Outils :** Frida, Objection, ADB, Burp Suite / mitmproxy

