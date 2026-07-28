<?php

namespace App\Models;

use CodeIgniter\Model;

class SkillModel extends Model
{
    protected $table            = 'skills';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'category', 'level', 'icon', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;

    public function getSkills()
    {
        try {
            return $this->orderBy('id', 'DESC')->findAll();
        } catch (\Throwable $e) {
            return [];
        }
    }
}
