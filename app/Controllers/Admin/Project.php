<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProjectModel;

class Project extends BaseController
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
            $projects = $this->projectModel->orderBy('created_at', 'DESC')->findAll();
        } catch (\Throwable $e) {
            log_message('error', 'Failed to load projects in admin: ' . $e->getMessage());
            $projects = [];
        }

        // Calculate statistics
        $totalProjects  = count($projects);
        $publishedCount = 0;
        $draftCount     = 0;
        $archivedCount  = 0;

        foreach ($projects as $proj) {
            $st = strtolower($proj['status'] ?? 'published');
            if ($st === 'published') {
                $publishedCount++;
            } elseif ($st === 'draft') {
                $draftCount++;
            } elseif ($st === 'archived') {
                $archivedCount++;
            }
        }

        $data = [
            'title'          => 'Admin Faiq | Data Scientist & AI Developer Portofolio',
            'projects'       => $projects,
            'totalProjects'  => $totalProjects,
            'publishedCount' => $publishedCount,
            'draftCount'     => $draftCount,
            'archivedCount'  => $archivedCount,
        ];

        return view('admin/projects/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title'   => 'Tambah Project | Admin Faiq',
            'project' => null,
            'isEdit'  => false,
        ];
        return view('admin/projects/tambah_projects', $data);
    }

    public function store()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title'       => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty|max_length[1000]',
            'github'      => 'permit_empty|valid_url_strict',
            'demo'        => 'permit_empty|valid_url_strict',
            'category'    => 'required',
            'status'      => 'required|in_list[published,draft,archived]',
            'thumbnail'   => 'permit_empty|uploaded[thumbnail]|max_size[thumbnail,2048]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $validation->getErrors()));
        }

        $title       = trim($this->request->getPost('title'));
        $description = trim($this->request->getPost('description') ?? '');
        $github      = trim($this->request->getPost('github') ?? '');
        $demo        = trim($this->request->getPost('demo') ?? '');
        $category    = trim($this->request->getPost('category'));
        $status      = trim($this->request->getPost('status'));

        // Handle technologies (array of selected tech names)
        $technologiesRaw = $this->request->getPost('technologies');
        $technologiesJson = null;
        if (!empty($technologiesRaw) && is_array($technologiesRaw)) {
            $technologiesJson = json_encode(array_values(array_filter($technologiesRaw)));
        }

        // Handle file upload
        $thumbnailName = null;
        $file = $this->request->getFile('thumbnail');
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Ensure upload directory exists
            $uploadPath = FCPATH . 'uploads/projects';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $thumbnailName = $file->getRandomName();
            $file->move($uploadPath, $thumbnailName);
        }

        $saveData = [
            'title'        => $title,
            'description'  => $description,
            'technologies' => $technologiesJson,
            'github'       => $github,
            'demo'         => $demo,
            'category'     => $category,
            'status'       => $status,
            'thumbnail'    => $thumbnailName,
        ];

        try {
            $this->projectModel->insert($saveData);
            return redirect()->to(base_url('admin/project'))->with('success', 'Project "' . esc($title) . '" berhasil ditambahkan!');
        } catch (\Throwable $e) {
            log_message('error', 'Failed to insert project: ' . $e->getMessage());
            return redirect()->to(base_url('admin/project'))->with('error', 'Gagal menyimpan project. Silakan coba lagi.');
        }
    }

    public function edit($id): string
    {
        $project = null;
        try {
            $project = $this->projectModel->find($id);
        } catch (\Throwable $e) {
            log_message('error', 'Failed to find project: ' . $e->getMessage());
            $project = null;
        }

        if (!$project) {
            return redirect()->to(base_url('admin/project'))->with('error', 'Project tidak ditemukan.');
        }

        $data = [
            'title'   => 'Edit Project | Admin Faiq',
            'project' => $project,
            'isEdit'  => true,
        ];

        return view('admin/projects/tambah_projects', $data);
    }

    public function update($id)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title'       => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty|max_length[1000]',
            'github'      => 'permit_empty|valid_url_strict',
            'demo'        => 'permit_empty|valid_url_strict',
            'category'    => 'required',
            'status'      => 'required|in_list[published,draft,archived]',
            'thumbnail'   => 'permit_empty|uploaded[thumbnail]|max_size[thumbnail,2048]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $validation->getErrors()));
        }

        $title       = trim($this->request->getPost('title'));
        $description = trim($this->request->getPost('description') ?? '');
        $github      = trim($this->request->getPost('github') ?? '');
        $demo        = trim($this->request->getPost('demo') ?? '');
        $category    = trim($this->request->getPost('category'));
        $status      = trim($this->request->getPost('status'));

        // Handle technologies (array of selected tech names)
        $technologiesRaw  = $this->request->getPost('technologies');
        $technologiesJson = null;
        if (!empty($technologiesRaw) && is_array($technologiesRaw)) {
            $technologiesJson = json_encode(array_values(array_filter($technologiesRaw)));
        }

        $saveData = [
            'title'        => $title,
            'description'  => $description,
            'technologies' => $technologiesJson,
            'github'       => $github,
            'demo'         => $demo,
            'category'     => $category,
            'status'       => $status,
        ];

        // Handle thumbnail upload if provided
        $file = $this->request->getFile('thumbnail');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Ensure upload directory exists
            $uploadPath = FCPATH . 'uploads/projects';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Delete old thumbnail if exists
            try {
                $oldProject = $this->projectModel->find($id);
                if ($oldProject && !empty($oldProject['thumbnail'])) {
                    $oldFile = $uploadPath . '/' . $oldProject['thumbnail'];
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }
            } catch (\Throwable $e) {
                log_message('warning', 'Failed to delete old thumbnail: ' . $e->getMessage());
            }
            
            $thumbnailName = $file->getRandomName();
            $file->move($uploadPath, $thumbnailName);
            $saveData['thumbnail'] = $thumbnailName;
        }

        try {
            $this->projectModel->update($id, $saveData);
            return redirect()->to(base_url('admin/project'))->with('success', 'Project "' . esc($title) . '" berhasil diperbarui!');
        } catch (\Throwable $e) {
            log_message('error', 'Failed to update project: ' . $e->getMessage());
            return redirect()->to(base_url('admin/project'))->with('error', 'Gagal memperbarui project. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        try {
            // Get project data first to delete thumbnail file
            $project = $this->projectModel->find($id);
            
            if ($project) {
                // Delete thumbnail file if exists
                if (!empty($project['thumbnail'])) {
                    $thumbnailPath = FCPATH . 'uploads/projects/' . $project['thumbnail'];
                    if (file_exists($thumbnailPath)) {
                        unlink($thumbnailPath);
                    }
                }
                
                // Delete project record
                $this->projectModel->delete($id);
                return redirect()->to(base_url('admin/project'))->with('success', 'Project "' . esc($project['title']) . '" berhasil dihapus!');
            } else {
                return redirect()->to(base_url('admin/project'))->with('error', 'Project tidak ditemukan.');
            }
        } catch (\Throwable $e) {
            log_message('error', 'Failed to delete project: ' . $e->getMessage());
            return redirect()->to(base_url('admin/project'))->with('error', 'Gagal menghapus project. Silakan coba lagi.');
        }
    }
}
