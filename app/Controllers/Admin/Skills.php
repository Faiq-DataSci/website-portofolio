<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SkillModel;

class Skills extends BaseController
{
    protected $skillModel;

    public function __construct()
    {
        $this->skillModel = new SkillModel();
    }

    public function index(): string
    {
        $skills = [];
        try {
            $skills = $this->skillModel->orderBy('category', 'ASC')
                                       ->orderBy('order_index', 'ASC')
                                       ->findAll();
        } catch (\Throwable $e) {
            log_message('error', 'Failed to load skills in admin: ' . $e->getMessage());
            $skills = [];
        }

        // Calculate statistics
        $totalSkills   = count($skills);
        $totalActive   = 0;
        $totalInactive = 0;
        $categories    = [];

        foreach ($skills as $skill) {
            $status = strtolower($skill['status'] ?? 'active');
            if ($status === 'active') {
                $totalActive++;
            } else {
                $totalInactive++;
            }
            
            $cat = $skill['category'] ?? 'Other';
            if (!in_array($cat, $categories)) {
                $categories[] = $cat;
            }
        }

        $data = [
            'title'         => 'Admin Skills | Faiq Portfolio',
            'skills'        => $skills,
            'totalSkills'   => $totalSkills,
            'totalActive'   => $totalActive,
            'totalInactive' => $totalInactive,
            'totalCategory' => count($categories),
        ];

        return view('admin/skills/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title'  => 'Tambah Skill | Admin Faiq',
            'skill'  => null,
            'isEdit' => false,
        ];
        return view('admin/skills/form', $data);
    }

    public function store()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'        => 'required|min_length[2]|max_length[100]',
            'category'    => 'required|max_length[50]',
            'level'       => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
            'icon'        => 'permit_empty|max_length[100]',
            'description' => 'permit_empty|max_length[500]',
            'order_index' => 'permit_empty|integer',
            'status'      => 'required|in_list[active,inactive]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $validation->getErrors()));
        }

        $name        = trim($this->request->getPost('name'));
        $category    = trim($this->request->getPost('category'));
        $level       = (int) $this->request->getPost('level');
        $icon        = trim($this->request->getPost('icon') ?? '');
        $description = trim($this->request->getPost('description') ?? '');
        $orderIndex  = (int) ($this->request->getPost('order_index') ?? 0);
        $status      = trim($this->request->getPost('status'));

        $saveData = [
            'name'        => $name,
            'category'    => $category,
            'level'       => $level,
            'icon'        => $icon,
            'description' => $description,
            'order_index' => $orderIndex,
            'status'      => $status,
        ];

        try {
            $this->skillModel->insert($saveData);
            return redirect()->to(base_url('admin/skills'))->with('success', 'Skill "' . esc($name) . '" berhasil ditambahkan!');
        } catch (\Throwable $e) {
            log_message('error', 'Failed to insert skill: ' . $e->getMessage());
            return redirect()->to(base_url('admin/skills'))->with('error', 'Gagal menyimpan skill. Silakan coba lagi.');
        }
    }

    public function edit($id): string
    {
        $skill = null;
        try {
            $skill = $this->skillModel->find($id);
        } catch (\Throwable $e) {
            log_message('error', 'Failed to find skill: ' . $e->getMessage());
            $skill = null;
        }

        if (!$skill) {
            return redirect()->to(base_url('admin/skills'))->with('error', 'Skill tidak ditemukan.');
        }

        $data = [
            'title'  => 'Edit Skill | Admin Faiq',
            'skill'  => $skill,
            'isEdit' => true,
        ];

        return view('admin/skills/form', $data);
    }

    public function update($id)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'        => 'required|min_length[2]|max_length[100]',
            'category'    => 'required|max_length[50]',
            'level'       => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
            'icon'        => 'permit_empty|max_length[100]',
            'description' => 'permit_empty|max_length[500]',
            'order_index' => 'permit_empty|integer',
            'status'      => 'required|in_list[active,inactive]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $validation->getErrors()));
        }

        $name        = trim($this->request->getPost('name'));
        $category    = trim($this->request->getPost('category'));
        $level       = (int) $this->request->getPost('level');
        $icon        = trim($this->request->getPost('icon') ?? '');
        $description = trim($this->request->getPost('description') ?? '');
        $orderIndex  = (int) ($this->request->getPost('order_index') ?? 0);
        $status      = trim($this->request->getPost('status'));

        $saveData = [
            'name'        => $name,
            'category'    => $category,
            'level'       => $level,
            'icon'        => $icon,
            'description' => $description,
            'order_index' => $orderIndex,
            'status'      => $status,
        ];

        try {
            $this->skillModel->update($id, $saveData);
            return redirect()->to(base_url('admin/skills'))->with('success', 'Skill "' . esc($name) . '" berhasil diperbarui!');
        } catch (\Throwable $e) {
            log_message('error', 'Failed to update skill: ' . $e->getMessage());
            return redirect()->to(base_url('admin/skills'))->with('error', 'Gagal memperbarui skill. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        try {
            $skill = $this->skillModel->find($id);
            
            if ($skill) {
                $this->skillModel->delete($id);
                return redirect()->to(base_url('admin/skills'))->with('success', 'Skill "' . esc($skill['name']) . '" berhasil dihapus!');
            } else {
                return redirect()->to(base_url('admin/skills'))->with('error', 'Skill tidak ditemukan.');
            }
        } catch (\Throwable $e) {
            log_message('error', 'Failed to delete skill: ' . $e->getMessage());
            return redirect()->to(base_url('admin/skills'))->with('error', 'Gagal menghapus skill. Silakan coba lagi.');
        }
    }
}
