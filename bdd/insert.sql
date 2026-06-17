
-- ============================================================================
-- INSERTIONS DE DEPART (5 produits et 2 caisses) [cite: 17]
-- ============================================================================

INSERT INTO Caisse (nom_caisse) VALUES ('Caisse Centrale 01');
INSERT INTO Caisse (nom_caisse) VALUES ('Caisse Rapide 02');

INSERT INTO Produit (designation, prix_unitaire) VALUES ('Biscuit', 1000); -- [cite: 37, 38]
INSERT INTO Produit (designation, prix_unitaire) VALUES ('Pain', 400); -- [cite: 41, 42]
INSERT INTO Produit (designation, prix_unitaire) VALUES ('Lait 1L', 3500);
INSERT INTO Produit (designation, prix_unitaire) VALUES ('Jus de Fruit', 5000);
INSERT INTO Produit (designation, prix_unitaire) VALUES ('Café 250g', 4500);

-- Initialisation du stock initial (Entrées)
INSERT INTO mvtStock (id_produit, quantite, type_mvt) VALUES (1, 100, 'ENTREE');
INSERT INTO mvtStock (id_produit, quantite, type_mvt) VALUES (2, 100, 'ENTREE');
INSERT INTO mvtStock (id_produit, quantite, type_mvt) VALUES (3, 100, 'ENTREE');
INSERT INTO mvtStock (id_produit, quantite, type_mvt) VALUES (4, 100, 'ENTREE');
INSERT INTO mvtStock (id_produit, quantite, type_mvt) VALUES (5, 100, 'ENTREE');