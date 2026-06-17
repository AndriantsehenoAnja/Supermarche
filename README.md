# Gestion de Caisse - Hypermarche

### Schéma Relationnel de la Base de Données
* **Utilisateur** (`id_user`, username, password) : Authentification des caissiers.
* **Caisse** (`id_caisse`, nom_caisse) : Liste des caisses disponibles.
* **Produit** (`id_produit`, designation, prix_unitaire) : Catalogue des articles (sans colonne stock redondante).
* **Achat** (`id_achat`, id_caisse, id_produit, quantite_achetee, num_ticket) : Lignes d'achats rattachées à un ticket client en cours.
* **mvtStock** (`id_mvt`, id_produit, quantite, type_mvt, date_mvt, id_achat) : Source unique de vérité pour le stock (`ENTREE` / `SORTIE`).

---

## Installation et Configuration Rapide

### 1. Prérequis
* PHP 8.1 ou supérieur avec l'extension `php-sqlite3` activée.
* Composer installé.

### 2. Configuration de l'environnement (`.env`)
À la racine du projet, assurez que le fichier `.env` contient les configurations suivantes :

```env
CI_ENVIRONMENT = development

# Configuration SQLite
database.default.DBDriver = SQLite3
database.default.database = writable/supermarche.db
database.default.foreignKeys = true

# Configuration des Sessions (Obligatoire pour l'IHM)
session.driver = 'CodeIgniter\Session\Handlers\FileHandler'
session.savePath = 'writable/session'

---

### reinitialisation de la base 

