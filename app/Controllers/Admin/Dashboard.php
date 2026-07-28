<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SkillModel;
use App\Models\ProjectModel;
use App\Models\CertificateModel;
use App\Models\VisitorLogModel;

class Dashboard extends BaseController
{
    protected $skillModel;
    protected $projectModel;
    protected $certificateModel;
    protected $visitorLogModel;

    public function __construct()
    {
        $this->skillModel = new SkillModel();
        $this->projectModel = new ProjectModel();
        $this->certificateModel = new CertificateModel();
        $this->visitorLogModel = new VisitorLogModel();
    }

    public function index(): string
    {
        // Disable cache untuk development
        $this->response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $this->response->setHeader('Pragma', 'no-cache');
        
        // Get Skills Statistics
        $skills = [];
        $totalSkills = 0;
        $activeSkills = 0;
        $skillCategories = [];

        try {
            $skills = $this->skillModel->findAll();
            $totalSkills = count($skills);
            
            foreach ($skills as $skill) {
                if (strtolower($skill['status'] ?? 'active') === 'active') {
                    $activeSkills++;
                }
                
                $category = $skill['category'] ?? 'Other';
                if (!in_array($category, $skillCategories)) {
                    $skillCategories[] = $category;
                }
            }
        } catch (\Throwable $e) {
            log_message('error', 'Failed to load skills in dashboard: ' . $e->getMessage());
        }

        // Get Projects Statistics
        $projects = [];
        $totalProjects = 0;
        $publishedProjects = 0;
        $draftProjects = 0;

        try {
            $projects = $this->projectModel->findAll();
            $totalProjects = count($projects);
            
            foreach ($projects as $project) {
                $status = strtolower($project['status'] ?? 'draft');
                if ($status === 'published') {
                    $publishedProjects++;
                } elseif ($status === 'draft') {
                    $draftProjects++;
                }
            }
        } catch (\Throwable $e) {
            log_message('error', 'Failed to load projects in dashboard: ' . $e->getMessage());
        }

        // Get Certificates Statistics
        $certificates = [];
        $totalCertificates = 0;
        $activeCertificates = 0;
        $shownCertificates = 0;

        try {
            $certificates = $this->certificateModel->findAll();
            $totalCertificates = count($certificates);
            
            foreach ($certificates as $cert) {
                if (strtolower($cert['status'] ?? 'active') === 'active') {
                    $activeCertificates++;
                }
                
                if (!empty($cert['is_show']) && $cert['is_show'] == 1) {
                    $shownCertificates++;
                }
            }
        } catch (\Throwable $e) {
            log_message('error', 'Failed to load certificates in dashboard: ' . $e->getMessage());
        }

        // Recent items (last 5)
        $recentSkills = array_slice(array_reverse($skills), 0, 5);
        $recentProjects = array_slice(array_reverse($projects), 0, 5);
        $recentCertificates = array_slice(array_reverse($certificates), 0, 5);

        // Visitor Statistics
        $totalVisitors = 0;
        $visitorsToday = 0;
        $visitorsThisWeek = 0;
        $visitorsThisMonth = 0;
        $last7DaysStats = [];
        $chartLabels = [];
        $chartData = [];

        try {
            $totalVisitors = $this->visitorLogModel->getTotalVisitors();
            $visitorsToday = $this->visitorLogModel->getVisitorsToday();
            $visitorsThisWeek = $this->visitorLogModel->getVisitorsThisWeek();
            $visitorsThisMonth = $this->visitorLogModel->getVisitorsThisMonth();
            
            // Get last 7 days statistics for chart
            $last7DaysStats = $this->visitorLogModel->getLast7DaysStats();
            
            foreach ($last7DaysStats as $stat) {
                $chartLabels[] = $stat['day'];
                $chartData[] = $stat['count'];
            }
        } catch (\Throwable $e) {
            log_message('error', 'Failed to load visitor statistics in dashboard: ' . $e->getMessage());
            
            // Default data if table doesn't exist yet
            $chartLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            $chartData = [0, 0, 0, 0, 0, 0, 0];
        }

        $data = [
            'title' => 'Admin Dashboard | Faiq Portfolio',
            
            // Skills Stats
            'totalSkills' => $totalSkills,
            'activeSkills' => $activeSkills,
            'skillCategories' => count($skillCategories),
            'recentSkills' => $recentSkills,
            
            // Projects Stats
            'totalProjects' => $totalProjects,
            'publishedProjects' => $publishedProjects,
            'draftProjects' => $draftProjects,
            'recentProjects' => $recentProjects,
            
            // Certificates Stats
            'totalCertificates' => $totalCertificates,
            'activeCertificates' => $activeCertificates,
            'shownCertificates' => $shownCertificates,
            'recentCertificates' => $recentCertificates,
            
            // Visitor Stats
            'totalVisitors' => $totalVisitors,
            'visitorsToday' => $visitorsToday,
            'visitorsThisWeek' => $visitorsThisWeek,
            'visitorsThisMonth' => $visitorsThisMonth,
            'chartLabels' => json_encode($chartLabels),
            'chartData' => json_encode($chartData),
        ];

        return view('admin/dashboard', $data);
    }
}
