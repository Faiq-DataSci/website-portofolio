<?php

namespace App\Models;

use CodeIgniter\Model;

class TechnologyColorModel extends Model
{
    protected $table            = 'technology_colors';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'color', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;

    /**
     * Get all technology colors
     */
    public function getTechnologyColors()
    {
        try {
            return $this->orderBy('name', 'ASC')->findAll();
        } catch (\Throwable $e) {
            log_message('error', 'Failed to get technology colors: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get technology colors as associative array (name => color)
     */
    public function getTechnologyColorsMap()
    {
        try {
            $colors = $this->findAll();
            $map = [];
            foreach ($colors as $tech) {
                $map[$tech['name']] = $tech['color'];
            }
            return $map;
        } catch (\Throwable $e) {
            log_message('error', 'Failed to get technology colors map: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get color by technology name
     */
    public function getColorByName(string $techName)
    {
        try {
            $tech = $this->where('name', $techName)->first();
            return $tech ? $tech['color'] : '#667eea'; // default color
        } catch (\Throwable $e) {
            log_message('error', 'Failed to get color by name: ' . $e->getMessage());
            return '#667eea';
        }
    }

    /**
     * Check if technology name already exists (for validation)
     */
    public function nameExists(string $name, ?int $excludeId = null): bool
    {
        try {
            $query = $this->where('name', $name);
            if ($excludeId !== null) {
                $query->where('id !=', $excludeId);
            }
            return $query->countAllResults() > 0;
        } catch (\Throwable $e) {
            log_message('error', 'Failed to check name exists: ' . $e->getMessage());
            return false;
        }
    }
}
