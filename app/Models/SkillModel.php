<?php

namespace App\Models;

use CodeIgniter\Model;

class SkillModel extends Model
{
    protected $table            = 'skills';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'category', 'level', 'icon', 'description', 'order_index', 'status'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    /**
     * Get all skills ordered by order_index and id
     */
    public function getSkills()
    {
        try {
            return $this->orderBy('order_index', 'ASC')
                        ->orderBy('id', 'DESC')
                        ->findAll();
        } catch (\Throwable $e) {
            log_message('error', 'Failed to get skills: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get active skills only
     */
    public function getActiveSkills()
    {
        try {
            return $this->where('status', 'active')
                        ->orderBy('category', 'ASC')
                        ->orderBy('order_index', 'ASC')
                        ->findAll();
        } catch (\Throwable $e) {
            log_message('error', 'Failed to get active skills: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get skills grouped by category
     */
    public function getSkillsByCategory()
    {
        try {
            $skills = $this->getActiveSkills();
            $grouped = [];
            
            foreach ($skills as $skill) {
                $category = $skill['category'] ?? 'Other';
                if (!isset($grouped[$category])) {
                    $grouped[$category] = [];
                }
                $grouped[$category][] = $skill;
            }
            
            return $grouped;
        } catch (\Throwable $e) {
            log_message('error', 'Failed to group skills: ' . $e->getMessage());
            return [];
        }
    }
}
