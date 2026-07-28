<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTechnologiesToProjects extends Migration
{
    public function up()
    {
        $this->forge->addColumn('projects', [
            'technologies' => [
                'type'    => 'TEXT',
                'null'    => true,
                'after'   => 'description',
                'comment' => 'JSON array of technology names, e.g. ["Python","Pandas","Jupyter"]',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('projects', 'technologies');
    }
}
