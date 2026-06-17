

### Travaux 1 : Base de données & Initialisation
- [x] Configuration du fichier `.env` pour piloter la base SQLite3 et activer les sessions.
- [x] Création des fichiers de Migrations pour les tables `Utilisateur`, `Caisse`, `Produit`, `Achat` et `mvtStock`.
- [x] Écriture et exécution du `InitialSeeder` pour injecter les 2 caisses, les 5 produits et le stock initial de 100 unités par produit (`ENTREE`).

### Travaux à faire 2 : Sélection de la Caisse
- [x] Création du modèle `CaisseModel`.
- [x] Création de la vue dynamique `caisse/index.php` qui charge les caisses depuis SQLite.
- [x] Création du contrôleur `Caisse.php` pour stocker la caisse active et un numéro de ticket aléatoire en Session (`num_ticket`).
- [x] Routage complet dans `Config/Routes.php`.

### Travaux à faire 3 : Écran de Saisie des Achats
- [ ] **Étape 3.1 : Créer la Vue d'Achat (`app/Views/caisse/achats.php`)**
  - Afficher dynamiquement le nom de la caisse active et du caissier récupérés depuis la session.
  - Intégrer un formulaire de saisie comprenant une liste déroulante des produits (générée dynamiquement) et un champ quantité.
  - Intégrer le tableau Bootstrap en bas affichant les lignes d'achats du ticket en cours.

- [ ] **Étape 3.2 : Adapter le modèle `ProduitModel` pour le calcul du stock**
  - Ajouter une méthode SQL personnalisée (avec des jointures et `SUM`) pour récupérer les produits combinés à leur stock réel calculé depuis `mvtStock` (Entrées - Sorties).

- [ ] **Étape 3.3 : Coder l'ajout d'une ligne dans le panier**
  - Réceptionner le produit et la quantité depuis le formulaire.
  - **Action 1 :** Faire un `INSERT` dans la table `Achat` avec l'ID de la caisse et le `num_ticket` de la session.
  - **Action 2 :** Faire un `INSERT` immédiat dans la table `mvtStock` avec le type `SORTIE` pour impacter directement le stock.
  - Recharger la page pour rafraîchir le tableau du bas et recalculer le total général en gras.
- 
### Travaux 4 : Authentification (Login) et Rajout un bouton « clôturer achat »
- [x] Création du modèle `UtilisateurModel`.
- [x] Création de la vue `auth/login.php` avec formulaire Bootstrap 5.
- [x] Création du contrôleur `Auth.php` gérant la vérification des identifiants et la mise en session globale.

