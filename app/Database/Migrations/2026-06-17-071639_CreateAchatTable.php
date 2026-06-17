<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAchatTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_achat'         => ['type' => 'INTEGER', 'constraint' => 11, 'auto_increment' => true],
            'id_caisse'        => ['type' => 'INTEGER', 'null' => false],
            'id_produit'       => ['type' => 'INTEGER', 'null' => false],
            'quantite_achetee' => ['type' => 'INTEGER', 'null' => false],
            'num_ticket'       => ['type' => 'INTEGER', 'null' => false],
        ]);
        $this->forge->addKey('id_achat', true);

        // Déclaration des clés étrangères
        $this->forge->addForeignKey('id_caisse', 'Caisse', 'id_caisse', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_produit', 'Produit', 'id_produit', 'CASCADE', 'CASCADE');

        $this->forge->createTable('Achat');
    }

    public function down()
    {
        $this->forge->dropTable('Achat');
    }
}
