<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        // 1. Insertion des Caisses
        $caisseModel = $this->db->table('Caisse');
        $caisses = [
            ['nom_caisse' => 'Caisse Centrale 01'],
            ['nom_caisse' => 'Caisse Rapide 02'],
        ];
        $caisseModel->insertBatch($caisses);

        // 2. Insertion des 5 Produits
        $produitModel = $this->db->table('Produit');
        $produits = [
            ['designation' => 'Biscuit', 'prix_unitaire' => 1000],
            ['designation' => 'Pain', 'prix_unitaire' => 400],
            ['designation' => 'Lait 1L', 'prix_unitaire' => 3500],
            ['designation' => 'Jus de Fruit', 'prix_unitaire' => 5000],
            ['designation' => 'Café 250g', 'prix_unitaire' => 4500],
        ];
        $produitModel->insertBatch($produits);

        // 3. Insertion du Stock Initial (100 unités pour chaque produit dans mvtStock)
        $mvtModel = $this->db->table('mvtStock');
        $mvts = [
            ['id_produit' => 1, 'quantite' => 100, 'type_mvt' => 'ENTREE'],
            ['id_produit' => 2, 'quantite' => 100, 'type_mvt' => 'ENTREE'],
            ['id_produit' => 3, 'quantite' => 100, 'type_mvt' => 'ENTREE'],
            ['id_produit' => 4, 'quantite' => 100, 'type_mvt' => 'ENTREE'],
            ['id_produit' => 5, 'quantite' => 100, 'type_mvt' => 'ENTREE'],
        ];
        $mvtModel->insertBatch($mvts);

        /* User */
        $this->db->table('Utilisateur')->insert([
        'username' => 'caissier1',
        'password' => password_hash('password123', PASSWORD_DEFAULT),
        ]);
    }
}