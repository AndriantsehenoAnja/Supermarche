<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCaisseTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_caisse' => ['type' => 'INTEGER', 'constraint' => 11, 'auto_increment' => true],
            'nom_caisse' => ['type' => 'TEXT', 'null' => false],
        ]);
        $this->forge->addKey('id_caisse', true);
        $this->forge->createTable('Caisse');
    }
    
    public function down()
    {
        $this->forge->dropTable('Caisse');
    }
}
