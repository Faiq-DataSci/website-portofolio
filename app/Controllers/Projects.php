<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\TechnologyColorModel;

class Projects extends BaseController
{
    protected $projectModel;
    protected $technologyColorModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->technologyColorModel = new TechnologyColorModel();
    }

    public function index(): string
    {
        $projects = [];
        try {
            // Hanya ambil project yang statusnya 'published'
            $projects = $this->projectModel
                ->where('status', 'published')
                ->orderBy('created_at', 'DESC')
                ->findAll();
            
            log_message('info', 'Projects loaded: ' . count($projects) . ' published projects found.');
        } catch (\Throwable $e) {
            log_message('error', 'Failed to load projects: ' . $e->getMessage());
            $projects = [];
        }

        $data = [
            'title'    => 'Faiq | Projects Portofolio',
            'projects' => $projects,
        ];
        return view('projects/index', $data);
    }

    public function detail($id)
    {
        try {
            $project = $this->projectModel->find($id);
            
            if (!$project) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Project not found'
                ])->setStatusCode(404);
            }

            // Only show published projects on frontend
            if (strtolower($project['status']) !== 'published') {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Project not available'
                ])->setStatusCode(404);
            }

            // Get technology colors map from database
            $technologyColorsMap = $this->technologyColorModel->getTechnologyColorsMap();

            // Parse technologies and add colors
            $technologies = [];
            if (!empty($project['technologies'])) {
                $techList = json_decode($project['technologies'], true);
                if (is_array($techList)) {
                    foreach ($techList as $tech) {
                        $technologies[] = [
                            'name'  => $tech,
                            'color' => $technologyColorsMap[$tech] ?? '#667eea' // default color if not found
                        ];
                    }
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'data' => [
                    'id'           => $project['id'],
                    'title'        => $project['title'],
                    'description'  => $project['description'],
                    'technologies' => $technologies,
                    'thumbnail'    => $project['thumbnail'] ? base_url('uploads/projects/' . $project['thumbnail']) : null,
                    'github'       => $project['github'],
                    'demo'         => $project['demo'],
                    'category'     => $project['category'],
                    'status'       => $project['status'],
                    'created_at'   => $project['created_at'],
                ]
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'Failed to load project detail: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Internal server error'
            ])->setStatusCode(500);
        }
    }
}
