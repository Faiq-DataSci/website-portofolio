<?php

namespace App\Controllers;

use App\Models\SkillModel;
use App\Models\CertificateModel;

class Skills extends BaseController
{
    protected $skillModel;
    protected $certificateModel;

    public function __construct()
    {
        $this->skillModel = new SkillModel();
        $this->certificateModel = new CertificateModel();
    }

    public function index()
    {
        // Get skills grouped by category
        $skillsGrouped = [];
        try {
            $skillsGrouped = $this->skillModel->getSkillsByCategory();
            log_message('info', 'Skills loaded for frontend: ' . count($skillsGrouped) . ' categories');
        } catch (\Throwable $e) {
            log_message('error', 'Failed to load skills for frontend: ' . $e->getMessage());
            $skillsGrouped = [];
        }

        // Get active certificates
        $certificates = [];
        try {
            $certificates = $this->certificateModel->getActiveCertificates();
            log_message('info', 'Certificates loaded for frontend: ' . count($certificates) . ' certificates');
        } catch (\Throwable $e) {
            log_message('error', 'Failed to load certificates for frontend: ' . $e->getMessage());
            $certificates = [];
        }

        $data = [
            'title' => 'Faiq | Skills Portofolio',
            'skillsGrouped' => $skillsGrouped,
            'certificates' => $certificates,
        ];
        
        return view('skills/index', $data);
    }
}
