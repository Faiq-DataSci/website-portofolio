<?php

namespace App\Controllers;

use App\Models\ProjectModel;

class Projects extends BaseController
{
    protected $projectModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
    }

    public function index(): string
    {
        $projects = [];
        try {
            // Hanya ambil project yang statusnya 'published'
            $projects = $this->projectModel
                ->where('status', 'published')
                ->orderBy('id', 'DESC')
                ->findAll();
        } catch (\Throwable $e) {
            $projects = [];
        }

        $data = [
            'title'    => 'Faiq | Projects Portofolio',
            'projects' => $projects,
        ];
        return view('projects/index', $data);
    }
}
