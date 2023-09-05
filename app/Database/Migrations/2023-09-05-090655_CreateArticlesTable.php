<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'content' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'category' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5,
                'null' => false,
            ],
            'writer' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5,
                'null' => false,
            ],
            'publish_date' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => TRUE
            ],
            'deleted_at' => [
                'type' => 'datetime',
                'null' => TRUE
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('writer', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('articles');
    }

    public function down()
    {
        //
    }
}
