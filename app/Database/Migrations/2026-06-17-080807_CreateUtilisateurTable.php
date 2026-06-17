<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUtilisateurTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'  => ['type' => 'INTEGER', 'constraint' => 11, 'auto_increment' => true],
            'username' => ['type' => 'TEXT', 'null' => false],
            'password' => ['type' => 'TEXT', 'null' => false],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('Utilisateur');
    }

    public function down()
    {
        $this->forge->dropTable('Utilisateur');
    }
}
