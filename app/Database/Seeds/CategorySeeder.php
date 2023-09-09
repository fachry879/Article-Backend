<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {

        $data = array(
            'Sports', 'Life Style', 'Otomitive', 'Travel', 'Foods', 'Health'
        );

        foreach ($data as $val) {
            $this->db->table('categories')->insert(['name' => $val]);
        }
    }
}
