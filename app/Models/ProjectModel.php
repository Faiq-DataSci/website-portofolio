<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table            = 'projects';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['title', 'description', 'thumbnail', 'github', 'demo', 'category', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;

    public function getProjects()
    {
        try {
            return $this->orderBy('id', 'DESC')->findAll();
        } catch (\Throwable $e) {
            return [];
        }
    }
}
