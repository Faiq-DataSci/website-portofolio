<?php

namespace App\Models;

use CodeIgniter\Model;

class CertificateModel extends Model
{
    protected $table            = 'gallery';  // Nanti akan di-rename ke 'certificates'
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['title', 'image', 'issuer', 'issue_date', 'status', 'is_show', 'size', 'description'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    /**
     * Get all certificates ordered by issue date
     */
    public function getCertificates()
    {
        try {
            return $this->orderBy('issue_date', 'DESC')
                        ->orderBy('id', 'DESC')
                        ->findAll();
        } catch (\Throwable $e) {
            log_message('error', 'Failed to get certificates: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get active and visible certificates only
     */
    public function getActiveCertificates()
    {
        try {
            return $this->where('status', 'active')
                        ->where('is_show', 1)
                        ->orderBy('issue_date', 'DESC')
                        ->findAll();
        } catch (\Throwable $e) {
            log_message('error', 'Failed to get active certificates: ' . $e->getMessage());
            return [];
        }
    }
}
