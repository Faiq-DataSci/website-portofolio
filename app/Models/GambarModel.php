<?php

namespace App\Models;

use CodeIgniter\Model;

class GambarModel extends Model
{
    protected $table            = 'gallery';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['title', 'image', 'category', 'status', 'is_show', 'size', 'description', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;

    public function getImages()
    {
        try {
            return $this->orderBy('id', 'DESC')->findAll();
        } catch (\Throwable $e) {
            return [];
        }
    }
}
