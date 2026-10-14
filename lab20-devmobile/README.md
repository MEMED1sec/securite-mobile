# TP 20 — NumberBook : Contacts Android & API distante via Retrofit

> **Cours :** Programmation Mobile — Android avec Java

---

##  Description

**NumberBook** est une application Android qui lit les contacts enregistrés dans le téléphone, les affiche dans une interface mobile, puis les envoie vers un serveur distant afin de les stocker dans une base de données. Elle permet également d'effectuer une **recherche distante** par nom ou par numéro de téléphone.

Ce projet met en relation plusieurs éléments clés du développement mobile moderne :

- l'accès aux données système Android
- la gestion des permissions
- la communication client/serveur
- la sérialisation JSON
- l'utilisation de **Retrofit** pour consommer une API REST
- la persistance des données dans une base distante

---

##  Aperçu de l'application



<img width="852" height="1847" alt="ChatGPT Image May 21, 2026, 09_44_41 PM" src="images/img-1.png" />


> _Capture de l'émulateur — boutons CHARGER LES CONTACTS, SYNCHRONISER VERS LE SERVEUR, champ de recherche, et liste des contacts affichés._

---

##  Objectifs pédagogiques

- Lire les contacts natifs du téléphone via le **ContentProvider** Android
- Gérer les **permissions runtime** (`READ_CONTACTS`)
- Envoyer des données JSON vers un serveur REST avec **Retrofit**
- Effectuer des requêtes de recherche distante (par nom / numéro)
- Afficher les résultats dans un **RecyclerView**

---

##  Architecture du projet

```
com.example.numberbook/
├── model/
│   └── Contact.java              # Modèle de données
├── api/
│   ├── ApiService.java           # Interface Retrofit (endpoints)
│   └── RetrofitClient.java       # Singleton Retrofit
├── repository/
│   └── ContactRepository.java    # Logique métier & appels réseau
├── viewmodel/
│   └── ContactViewModel.java     # ViewModel + LiveData
├── adapter/
│   └── ContactAdapter.java       # Adapter RecyclerView
└── MainActivity.java             # Vue principale (UI)
```

---

##  Scénario de fonctionnement

```
Téléphone
    └─► Lecture des contacts (ContentProvider + Permission)
            └─► Affichage local (RecyclerView)
                    └─► [Bouton Synchroniser]
                            └─► Envoi JSON via Retrofit (POST /contacts)
                                        └─► Serveur distant (BDD)
                                                └─► [Bouton Rechercher]
                                                        └─► GET /contacts?query=...
                                                                └─► Résultats affichés
```

---

##  Fonctionnalités

- ✅ Chargement des contacts depuis le téléphone
- ✅ Affichage de la liste avec nom et numéro
- ✅ Synchronisation vers le serveur distant (API REST)
- ✅ Recherche distante par nom ou numéro de téléphone
- ✅ Gestion des permissions Android (`READ_CONTACTS`)

---

##  Parties du TP

| # | Partie |
|---|--------|
| 1 | Conception de la base de données distante |
| 2 | Développement du backend distant |
| 3 | Développement Android |
| 4 | Interface utilisateur |
| 5 | Modèles Android |
| 6 | Communication réseau avec Retrofit |
| 7 | Affichage avec RecyclerView |
| 8 | Développement de MainActivity |

---

##  Dépendances (build.gradle)

```groovy
// Retrofit + Gson
implementation "com.squareup.retrofit2:retrofit:2.9.0"
implementation "com.squareup.retrofit2:converter-gson:2.9.0"

// ViewModel & LiveData
implementation "androidx.lifecycle:lifecycle-viewmodel:2.7.0"
implementation "androidx.lifecycle:lifecycle-livedata:2.7.0"

// RecyclerView
implementation "androidx.recyclerview:recyclerview:1.3.2"
```

### Permission dans AndroidManifest.xml

```xml
<uses-permission android:name="android.permission.READ_CONTACTS" />
<uses-permission android:name="android.permission.INTERNET" />
```

---

##  Installation & lancement

1. Cloner le dépôt :
   ```bash
   git clone https://github.com/<votre-utilisateur>/<votre-repo>.git
   ```
2. Ouvrir le projet dans **Android Studio**.
3. Configurer l'URL du serveur backend dans `RetrofitClient.java` :
   ```java
   private static final String BASE_URL = "http://<votre-ip>:<port>/";
   ```
4. Synchroniser Gradle (`Sync Now`).
5. Lancer sur un émulateur ou appareil physique.

---

##  Points importants

> **Permissions runtime :** à partir d'Android 6.0 (API 23), la permission `READ_CONTACTS` doit être demandée dynamiquement à l'utilisateur, pas seulement déclarée dans le manifest.

> **Réseau & émulateur :** pour pointer vers un serveur local depuis l'émulateur, utilisez `10.0.2.2` à la place de `localhost`.

> **Trafic HTTP clair :** si votre API tourne en HTTP (non HTTPS), ajoutez `android:usesCleartextTraffic="true"` dans le manifest ou configurez un `network_security_config`.

---

## 👨‍💻 Auteur

- **Nom :** HMAMI Mohamed
- **Cours :** Programmation Mobile — Android avec Java

