<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCertificatesTable extends Migration
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
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'comment'    => 'Certificate name/title',
            ],
            'issuer' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
                'comment'    => 'Certificate issuer (e.g., Coursera, Google)',
            ],
            'issue_date' => [
                'type'    => 'DATE',
                'null'    => true,
                'comment' => 'Certificate issue date',
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => 'default.jpg',
                'comment'    => 'Certificate image filename',
            ],
            'size' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'comment'    => 'Image file size',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'Certificate description',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'    => 'active',
                'comment'    => 'Certificate status',
            ],
            'is_show' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'comment'    => '1 = show in frontend, 0 = hidden',
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
        $this->forge->addKey('status');
        $this->forge->addKey('is_show');
        $this->forge->addKey('issue_date');
        $this->forge->createTable('gallery'); // Menggunakan nama 'gallery' untuk sementara, bisa direname nanti
    }

    public function down()
    {
        $this->forge->dropTable('gallery');
    }
}
