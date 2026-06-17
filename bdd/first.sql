-- Active la vérification des clés étrangères dans SQLite
PRAGMA foreign_keys = ON;

-- 1. Table des produits (SANS qte_stock !) [cite: 18]
CREATE TABLE Produit (
    id_produit INTEGER PRIMARY KEY AUTOINCREMENT,
    designation TEXT NOT NULL, -- [cite: 7]
    prix_unitaire REAL NOT NULL -- [cite: 8]
);

-- 2. Table des caisses [cite: 19]
CREATE TABLE Caisse (
    id_caisse INTEGER PRIMARY KEY AUTOINCREMENT,
    nom_caisse TEXT NOT NULL
);

-- 3. Table des achats (Lignes de panier d'un client) [cite: 20]
CREATE TABLE Achat (
    id_achat INTEGER PRIMARY KEY AUTOINCREMENT,
    id_caisse INTEGER NOT NULL,
    id_produit INTEGER NOT NULL,
    quantite_achetee INTEGER NOT NULL,
    num_ticket INTEGER NOT NULL, -- Permet de grouper les lignes d'un même client [cite: 52]
    FOREIGN KEY (id_caisse) REFERENCES Caisse(id_caisse),
    FOREIGN KEY (id_produit) REFERENCES Produit(id_produit)
);

-- 4. Table des mouvements de stock (L'unique source de vérité pour le stock)
CREATE TABLE mvtStock (
    id_mvt INTEGER PRIMARY KEY AUTOINCREMENT,
    id_produit INTEGER NOT NULL,
    quantite INTEGER NOT NULL,
    type_mvt TEXT CHECK(type_mvt IN ('ENTREE', 'SORTIE')) NOT NULL,
    date_mvt DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_achat INTEGER, -- Optionnel, lié à l'achat si c'est une SORTIE
    FOREIGN KEY (id_produit) REFERENCES Produit(id_produit),
    FOREIGN KEY (id_achat) REFERENCES Achat(id_achat)
);
