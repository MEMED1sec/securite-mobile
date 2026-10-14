# LAB 16 : Maîtriser les Services dans une Application Android
### Cours : Programmation Mobile – Android avec Java

---

## Objectifs du lab

Créer une application **Chronomètre Service** entièrement en Java qui utilise :

| Composant | Description |
|-----------|-------------|
| **Foreground Service** | Obligatoire depuis Android 8.0 |
| **Notification persistante** | Affiche le temps en direct |
| **Bound Service** | Communique avec l'Activity |
| **Démarrage/Arrêt** | Contrôlé depuis l'interface |

> Vous comprendrez parfaitement le cycle de vie des Services, `onStartCommand`, `onBind`, `START_STICKY`, les restrictions Android et les bonnes pratiques.

---

##  Réalisations

###  État initial – Service prêt


<img width="263" height="549" alt="image" src="images/img-1.png" />


###  État actif – Chronomètre en cours (00:05)


<img width="263" height="549" alt="image" src="images/img-2.png" />


---

##  Architecture du projet

```
app/src/main/java/com.example.lab16/
│
├── service/
│   └── ChronometerService.java     ← Foreground Service + Bound Service
│
├── MainActivity.java               ← UI : Démarrer / Arrêter + affichage temps
│
res/
├── layout/
│   └── activity_main.xml           ← Layout : chronomètre + boutons
└── drawable/
    └── ic_timer.xml                ← Icône notification
```

---

##  Étapes du Lab

### Étape 1 — Créer le projet *(3 min)*
- Nouveau projet Android (Empty Activity)
- Langue : **Java**, `minSdk 21`

### Étape 2 — Créer la classe du Service *(15 min)*
- Étendre `Service`
- Implémenter `onStartCommand()` avec `START_STICKY`
- Implémenter `onBind()` pour le Bound Service
- Lancer un `Handler` / `Runnable` pour incrémenter le temps chaque seconde

### Étape 3 — Déclarer le Service dans le Manifest *(2 min)*
```xml
<service
    android:name=".service.ChronometerService"
    android:foregroundServiceType="dataSync" />
```

### Étape 4 — Permission pour les notifications *(1 min)*
```xml
<uses-permission android:name="android.permission.FOREGROUND_SERVICE" />
<uses-permission android:name="android.permission.POST_NOTIFICATIONS" />
```

### Étape 5 — Créer l'Activity *(12 min)*
- Binder pour se connecter au Service
- `ServiceConnection` pour récupérer le temps en direct
- Mise à jour du `TextView` chronomètre via callback

### Étape 6 — Le layout *(2 min)*
- `TextView` TEMPS ÉCOULÉ (format `MM:SS`)
- Bouton **Démarrer le Service** (bleu/violet)
- Bouton **Arrêter le Service** (rouge)
- Badge statut : *Service prêt* / *Chronomètre actif*

### Étape 7 — Lancer et tester *(5 min)*
- Vérifier la notification persistante dans la barre de statut
- Tester le maintien du chronomètre en arrière-plan
- Tester l'arrêt propre du service

---

##  Vérification

- [ ] Le service démarre sans crash sur Android 8+
- [ ] La notification persistante s'affiche avec le temps en direct
- [ ] Le chronomètre continue de tourner quand l'app passe en arrière-plan
- [ ] Le bouton Arrêter stoppe bien le service et remet le compteur à zéro
- [ ] Aucune fuite mémoire (unbind dans `onStop()`)

---

##  Dépendances (build.gradle)

```groovy
android {
    compileSdk 34
    defaultConfig {
        minSdk 21
        targetSdk 34
    }
}
dependencies {
    implementation 'androidx.appcompat:appcompat:1.6.1'
    implementation 'com.google.android.material:material:1.11.0'
    implementation 'androidx.core:core:1.12.0'
}
```

---

##  Points clés à retenir

| Concept | Explication |
|---------|-------------|
| `START_STICKY` | Le Service redémarre automatiquement si tué par le système |
| `startForeground()` | Obligatoire sur Android 8+ pour les services longue durée |
| `IBinder` / `Binder` | Permet à l'Activity de récupérer une référence directe au Service |
| `unbindService()` | Toujours appeler dans `onStop()` pour éviter les fuites |
| `NotificationChannel` | Obligatoire sur Android 8+ pour afficher les notifications |

---

##  Conclusion

> Ce lab couvre l'ensemble du cycle de vie des **Android Services** :
> Foreground, Bound, notifications persistantes et communication Activity ↔ Service.
> Ces concepts sont essentiels pour toute app nécessitant une exécution en arrière-plan
> (musique, GPS, synchronisation, minuteries).

---

##  Auteur

**HMAMI Mohamed**
Cours : Programmation Mobile – Android avec Java

