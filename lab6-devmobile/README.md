#  Application Android - Pizza Recipes

##  Présentation

Pizza Recipes est une application mobile Android développée en Java.  
Elle affiche plusieurs recettes de pizzas sous forme de liste.

Chaque pizza contient une image, un nom, une durée de préparation et un nombre de portions.  
Après avoir cliqué sur une pizza, l’utilisateur accède à une page détaillée contenant toutes les informations de la recette.

---

##  But du travail

Ce lab a pour objectif de mettre en pratique les notions essentielles du développement Android avec Java.

Il permet de comprendre :

- La création d’interfaces avec XML
- L’utilisation de plusieurs activités
- La création d’un adapter personnalisé
- La gestion des données avec une classe service
- Le passage d’informations entre deux écrans
- L’organisation du projet en couches

---

##  Environnement de développement

- Android Studio
- Java
- XML
- Pixel 5 Emulator
- Minimum SDK : API 24
- Architecture organisée en packages

---


##  Description des composants

### Produit.java

Cette classe représente une pizza.  
Elle contient les informations principales d’une recette :

- Identifiant
- Nom
- Prix
- Image
- Durée
- Ingrédients
- Description
- Étapes de préparation

---

### IDao.java

Cette interface définit les opérations de base utilisées pour manipuler les objets :

- create
- update
- delete
- findById
- findAll

---

### ProduitService.java

Cette classe gère les pizzas en mémoire.  
Elle joue le rôle d’une petite base de données locale.

---

### PizzaAdapter.java

L’adapter permet d’afficher chaque pizza dans une ligne personnalisée de la liste.

---

### ListPizzaActivity.java

Cette activité affiche la liste des pizzas à l’utilisateur.

---

### PizzaDetailActivity.java

Cette activité affiche les détails de la pizza sélectionnée.

---

##  Captures d’écran du projet

### 1. Écran principal : liste des pizzas


<img width="260" height="505" alt="image" src="images/img-1.png" />


---

### 2. Écran de détail : Seafood Pizza



<img width="246" height="522" alt="image" src="images/img-2.png" />


---

##  Fonctionnement de l’application

1. L’application démarre avec un écran de chargement.
2. Après quelques secondes, la liste des pizzas apparaît.
3. L’utilisateur choisit une pizza.
4. Une nouvelle page s’ouvre avec les détails de la recette.
5. Les informations affichées comprennent l’image, le nom, la durée, la description, les ingrédients et les étapes.

---

##  Exemples de pizzas utilisées

- Seafood Pizza
- Pesto Chicken Pizza
- Deep-Dish Sausage Pizza
- Mushroom Pizza
- Spicy Chicken Pizza

---

##  Résultat obtenu

Le résultat final est une application Android fonctionnelle qui permet de consulter plusieurs recettes de pizzas avec une navigation simple entre la liste et les détails.

---

##  Ce que ce lab m’a permis d’apprendre

Ce travail m’a permis de mieux comprendre :

- La création d’une application Android Java.
- L’utilisation d’une ListView.
- Le rôle d’un adapter personnalisé.
- La séparation du code en plusieurs packages.
- Le passage de données avec Intent.
- La création d’écrans XML.
- L’organisation d’un projet Android propre.

---


