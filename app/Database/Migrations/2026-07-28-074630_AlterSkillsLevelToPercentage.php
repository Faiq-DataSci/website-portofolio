<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterSkillsLevelToPercentage extends Migration
{
    public function up()
    {
        // Ubah kolom level dari ENUM ke INT (persentase 0-100)
        $fields = [
            'level' => [
                'type'       => 'INT',
                'constraint' => 3,
                'unsigned'   => true,
                'default'    => 50,
                'comment'    => 'Skill level in percentage (0-100)',
            ],
        ];

        $this->forge->modifyColumn('skills', $fields);
    }

    public function down()
    {
        // Kembalikan ke ENUM jika rollback
        $fields = [
            'level' => [
                'type'       => 'ENUM',
                'constraint' => ['Beginner', 'Intermediate', 'Advanced', 'Expert'],
                'default'    => 'Intermediate',
            ],
        ];

        $this->forge->modifyColumn('skills', $fields);
    }
}
