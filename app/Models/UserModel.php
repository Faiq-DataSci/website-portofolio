<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['username', 'email', 'password', 'name', 'role', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;

    public function getUserByUsernameOrEmail(string $identifier)
    {
        try {
            return $this->where('username', $identifier)
                        ->orWhere('email', $identifier)
                        ->first();
        } catch (\Throwable $e) {
            return null;
        }
    }
}
