# LAB 14 : Sauvegarde des données – SharedPreferences et fichiers
### Cours : Programmation Mobile – Android avec Java

---

##  Aperçu

Ce lab met en place une **persistance locale complète** sous Android en Java :
- SharedPreferences
- EncryptedSharedPreferences
- Fichiers internes (Internal Storage)
- Cache (`cacheDir`)
- Stockage externe app-specific

L'objectif est de produire une application exécutable **hors Internet**, en appliquant des règles strictes de sécurité (pas de secrets en clair, logs contrôlés, nettoyage).

---

##  Objectifs d'apprentissage

- Écrire et lire des préférences via **SharedPreferences** (`apply` vs `commit`)
- Stocker un secret (token) chiffré via **EncryptedSharedPreferences + MasterKey**
- Écrire et lire des fichiers internes (texte UTF-8, JSON simple)
- Utiliser un cache temporaire (`cacheDir`) et le purger
- Exporter un fichier vers l'externe **app-specific** et comprendre les permissions
- Appliquer une checklist sécurité (logs, `MODE_PRIVATE`, nettoyage, rotation conceptuelle de token)

---

##  Réalisations

### Écran 1 – Chargement des préférences (SharedPreferences)


<img width="268" height="600" alt="image" src="images/img-1.png" />


*Résultat affiché : `name=`, `lang=fr`, `theme=system`, `tokenLength=0`*

---

### Écran 2 – Chargement du fichier JSON (Internal Storage)


<img width="325" height="580" alt="image" src="images/img-2.png" />


*Résultat affiché : liste de 3 étudiants chargée depuis le fichier JSON interne*

---

##  Dépendances (build.gradle)

```groovy
dependencies {
    implementation "androidx.security:security-crypto:1.1.0-alpha06"
    implementation "com.google.code.gson:gson:2.10.1"
}
```

---

##  Étapes du Lab

| # | Tâche | Description |
|---|-------|-------------|
| 1 | Création du projet | Setup + dépendances nécessaires + Vérification |
| 2 | SharedPreferences | Lecture/écriture + `apply` vs `commit` + thème/langue + Vérification |
| 3 | Sécurité des préférences | EncryptedSharedPreferences + Vérification |
| 4 | Fichiers internes | Internal Storage + JSON simple + Vérification |
| 5 | Cache | `cacheDir` + stockage temporaire + Vérification |
| 6 | Stockage externe | App-specific external + permissions + Vérification |

---

## Checklist de sécurité

- [x] Aucun secret stocké en clair
- [x] Utilisation de `MODE_PRIVATE` uniquement
- [x] Logs filtrés (pas de données sensibles)
- [x] Nettoyage du cache effectué
- [x] Rotation conceptuelle du token implémentée

---


Cours : Programmation Mobile – Android avec Java

