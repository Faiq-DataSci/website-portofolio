<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TechnologyColorModel;

class TechnologyColor extends BaseController
{
    protected $technologyColorModel;

    public function __construct()
    {
        $this->technologyColorModel = new TechnologyColorModel();
    }

    /**
     * Display technology colors list
     */
    public function index(): string
    {
        $technologies = [];
        try {
            $technologies = $this->technologyColorModel->getTechnologyColors();
        } catch (\Throwable $e) {
            log_message('error', 'Failed to load technology colors in admin: ' . $e->getMessage());
            $technologies = [];
        }

        $data = [
            'title'         => 'Technology Colors | Admin Faiq',
            'technologies'  => $technologies,
            'totalTech'     => count($technologies),
        ];

        return view('admin/technology_colors/index', $data);
    }

    /**
     * Display create form
     */
    public function create(): string
    {
        $data = [
            'title'      => 'Tambah Technology Color | Admin Faiq',
            'technology' => null,
            'isEdit'     => false,
        ];
        return view('admin/technology_colors/form', $data);
    }

    /**
     * Store new technology color
     */
    public function store()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'  => 'required|min_length[2]|max_length[100]',
            'color' => 'required|regex_match[/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $validation->getErrors()));
        }

        $name  = trim($this->request->getPost('name'));
        $color = trim($this->request->getPost('color'));

        // Check if name already exists
        if ($this->technologyColorModel->nameExists($name)) {
            return redirect()->back()->withInput()->with('error', 'Teknologi "' . esc($name) . '" sudah ada!');
        }

        $saveData = [
            'name'  => $name,
            'color' => $color,
        ];

        try {
            $this->technologyColorModel->insert($saveData);
            return redirect()->to(base_url('admin/technology-colors'))->with('success', 'Technology color "' . esc($name) . '" berhasil ditambahkan!');
        } catch (\Throwable $e) {
            log_message('error', 'Failed to insert technology color: ' . $e->getMessage());
            return redirect()->to(base_url('admin/technology-colors'))->with('error', 'Gagal menyimpan technology color. Silakan coba lagi.');
        }
    }

    /**
     * Display edit form
     */
    public function edit($id): string
    {
        $technology = null;
        try {
            $technology = $this->technologyColorModel->find($id);
        } catch (\Throwable $e) {
            log_message('error', 'Failed to find technology color: ' . $e->getMessage());
            $technology = null;
        }

        if (!$technology) {
            return redirect()->to(base_url('admin/technology-colors'))->with('error', 'Technology color tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Technology Color | Admin Faiq',
            'technology' => $technology,
            'isEdit'     => true,
        ];

        return view('admin/technology_colors/form', $data);
    }

    /**
     * Update technology color
     */
    public function update($id)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'  => 'required|min_length[2]|max_length[100]',
            'color' => 'required|regex_match[/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $validation->getErrors()));
        }

        $name  = trim($this->request->getPost('name'));
        $color = trim($this->request->getPost('color'));

        // Check if name already exists (excluding current id)
        if ($this->technologyColorModel->nameExists($name, $id)) {
            return redirect()->back()->withInput()->with('error', 'Teknologi "' . esc($name) . '" sudah ada!');
        }

        $saveData = [
            'name'  => $name,
            'color' => $color,
        ];

        try {
            $this->technologyColorModel->update($id, $saveData);
            return redirect()->to(base_url('admin/technology-colors'))->with('success', 'Technology color "' . esc($name) . '" berhasil diperbarui!');
        } catch (\Throwable $e) {
            log_message('error', 'Failed to update technology color: ' . $e->getMessage());
            return redirect()->to(base_url('admin/technology-colors'))->with('error', 'Gagal memperbarui technology color. Silakan coba lagi.');
        }
    }

    /**
     * Delete technology color
     */
    public function delete($id)
    {
        try {
            $technology = $this->technologyColorModel->find($id);
            
            if ($technology) {
                $this->technologyColorModel->delete($id);
                return redirect()->to(base_url('admin/technology-colors'))->with('success', 'Technology color "' . esc($technology['name']) . '" berhasil dihapus!');
            } else {
                return redirect()->to(base_url('admin/technology-colors'))->with('error', 'Technology color tidak ditemukan.');
            }
        } catch (\Throwable $e) {
            log_message('error', 'Failed to delete technology color: ' . $e->getMessage());
            return redirect()->to(base_url('admin/technology-colors'))->with('error', 'Gagal menghapus technology color. Silakan coba lagi.');
        }
    }
}
