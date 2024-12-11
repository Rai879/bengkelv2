<?php

namespace App\Models;

use CodeIgniter\Model;

class userModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password'];

    // Metode untuk memeriksa kredensial pengguna
    public function login($username, $password)
    {
        $user = $this->db->table('users')->where('username', $username)->get()->getRowArray();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return false;
    }
}
