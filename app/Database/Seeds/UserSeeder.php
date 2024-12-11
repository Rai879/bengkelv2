<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'   => 'raya',
                'password'   => password_hash('11111', PASSWORD_BCRYPT),
                'level'      => 'admin',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
