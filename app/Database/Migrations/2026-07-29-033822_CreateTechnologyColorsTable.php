<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTechnologyColorsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
                'comment'    => 'Nama teknologi (contoh: HTML, CSS, JavaScript)',
            ],
            'color' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'default'    => '#667eea',
                'comment'    => 'Kode warna hex (contoh: #FF5733)',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('technology_colors');
    }

    public function down()
    {
        $this->forge->dropTable('technology_colors');
    }
}
