<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMvtStockTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mvt'     => ['type' => 'INTEGER', 'constraint' => 11, 'auto_increment' => true],
            'id_produit' => ['type' => 'INTEGER', 'null' => false],
            'quantite'   => ['type' => 'INTEGER', 'null' => false],
            'type_mvt'   => ['type' => 'TEXT', 'null' => false], // 'ENTREE' ou 'SORTIE'
            'date_mvt'   => ['type' => 'DATETIME', 'null' => true],
            'id_achat'   => ['type' => 'INTEGER', 'null' => true],
        ]);
        $this->forge->addKey('id_mvt', true);
        
        $this->forge->addForeignKey('id_produit', 'Produit', 'id_produit', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_achat', 'Achat', 'id_achat', 'SET NULL', 'CASCADE');
        
        $this->forge->createTable('mvtStock');
    }
    
    public function down()
    {
        $this->forge->dropTable('mvtStock');
    }
}
