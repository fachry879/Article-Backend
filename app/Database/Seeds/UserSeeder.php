<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'email'    => 'darth@theempire.com',
            'password' => '123',
            'full_name' => 'john Doe'
        ];

        $this->db->table('users')->insert($data);
    }
}
