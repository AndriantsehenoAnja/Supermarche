<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProduitTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produit' => ['type' => 'INTEGER', 'constraint' => 11, 'auto_increment' => true],
            'designation' => ['type' => 'TEXT', 'null' => false], 
            'prix_unitaire' => ['type' => 'REAL', 'null' => false],
        ]);
        $this->forge->addKey('id_produit', true);
        $this->forge->createTable('Produit');
    }

    public function down()
    {
        $this->forge->dropTable('Produit');
    }
}
