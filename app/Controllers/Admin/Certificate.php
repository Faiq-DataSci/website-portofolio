<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CertificateModel;

class Certificate extends BaseController
{
    protected $certificateModel;

    public function __construct()
    {
        $this->certificateModel = new CertificateModel();
    }

    public function index(): string
    {
        $certificates = [];
        try {
            $certificates = $this->certificateModel->orderBy('id', 'DESC')->findAll();
        } catch (\Throwable $e) {
            log_message('error', 'Failed to load certificates: ' . $e->getMessage());
            $certificates = [];
        }

        // Calculate statistics
        $totalCertificate = count($certificates);
        $totalActive      = 0;
        $totalShow        = 0;
        $totalHidden      = 0;

        foreach ($certificates as $cert) {
            if (($cert['status'] ?? 'active') === 'active') {
                $totalActive++;
            }
            if (!empty($cert['is_show'])) {
                $totalShow++;
            } else {
                $totalHidden++;
            }
        }

        $data = [
            'title'            => 'Admin Certificate | Faiq Portfolio',
            'certificates'     => $certificates,
            'totalCertificate' => $totalCertificate,
            'totalActive'      => $totalActive,
            'totalShow'        => $totalShow,
            'totalHidden'      => $totalHidden,
        ];

        return view('admin/certificates/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title'       => 'Tambah Certificate | Admin Faiq',
            'certificate' => null,
            'isEdit'      => false,
        ];
        return view('admin/certificates/form', $data);
    }

    public function store()
    {
        $title       = trim($this->request->getPost('title') ?? '');
        $issuer      = trim($this->request->getPost('issuer') ?? '');
        $issueDate   = trim($this->request->getPost('issue_date') ?? '');
        $description = trim($this->request->getPost('description') ?? '');
        $status      = trim($this->request->getPost('status') ?? 'active');
        $isShow      = (int) ($this->request->getPost('is_show') ?? 1);

        if (empty($title)) {
            return redirect()->back()->withInput()->with('error', 'Judul certificate wajib diisi.');
        }

        // Handle file upload
        $imageName     = 'default.jpg';
        $formattedSize = '0 KB';
        $file          = $this->request->getFile('image');
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $bytes     = $file->getSize();
            
            if ($bytes >= 1048576) {
                $formattedSize = number_format($bytes / 1048576, 1) . ' MB';
            } else {
                $formattedSize = round($bytes / 1024) . ' KB';
            }
            
            // Create upload directory if not exists
            $uploadPath = FCPATH . 'uploads/certificates';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $file->move($uploadPath, $imageName);
        }

        $saveData = [
            'title'       => $title,
            'issuer'      => $issuer,
            'issue_date'  => $issueDate ?: null,
            'description' => $description,
            'status'      => $status,
            'is_show'     => $isShow,
            'image'       => $imageName,
            'size'        => $formattedSize,
        ];

        try {
            $this->certificateModel->insert($saveData);
            return redirect()->to(base_url('admin/certificates'))->with('success', 'Certificate "' . esc($title) . '" berhasil ditambahkan!');
        } catch (\Throwable $e) {
            log_message('error', 'Failed to insert certificate: ' . $e->getMessage());
            return redirect()->to(base_url('admin/certificates'))->with('error', 'Gagal menyimpan certificate. Silakan coba lagi.');
        }
    }

    public function edit($id): string
    {
        $certificate = null;
        try {
            $certificate = $this->certificateModel->find($id);
        } catch (\Throwable $e) {
            log_message('error', 'Failed to find certificate: ' . $e->getMessage());
            $certificate = null;
        }

        if (!$certificate) {
            return redirect()->to(base_url('admin/certificates'))->with('error', 'Certificate tidak ditemukan.');
        }

        $data = [
            'title'       => 'Edit Certificate | Admin Faiq',
            'certificate' => $certificate,
            'isEdit'      => true,
        ];

        return view('admin/certificates/form', $data);
    }

    public function update($id)
    {
        $title       = trim($this->request->getPost('title') ?? '');
        $issuer      = trim($this->request->getPost('issuer') ?? '');
        $issueDate   = trim($this->request->getPost('issue_date') ?? '');
        $description = trim($this->request->getPost('description') ?? '');
        $status      = trim($this->request->getPost('status') ?? 'active');
        $isShow      = (int) ($this->request->getPost('is_show') ?? 1);

        if (empty($title)) {
            return redirect()->back()->withInput()->with('error', 'Judul certificate wajib diisi.');
        }

        $saveData = [
            'title'       => $title,
            'issuer'      => $issuer,
            'issue_date'  => $issueDate ?: null,
            'description' => $description,
            'status'      => $status,
            'is_show'     => $isShow,
        ];

        // Handle file upload if exists
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $bytes     = $file->getSize();
            
            if ($bytes >= 1048576) {
                $saveData['size'] = number_format($bytes / 1048576, 1) . ' MB';
            } else {
                $saveData['size'] = round($bytes / 1024) . ' KB';
            }
            
            $uploadPath = FCPATH . 'uploads/certificates';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $file->move($uploadPath, $imageName);
            $saveData['image'] = $imageName;
        }

        try {
            $this->certificateModel->update($id, $saveData);
            return redirect()->to(base_url('admin/certificates'))->with('success', 'Certificate "' . esc($title) . '" berhasil diperbarui!');
        } catch (\Throwable $e) {
            log_message('error', 'Failed to update certificate: ' . $e->getMessage());
            return redirect()->to(base_url('admin/certificates'))->with('error', 'Gagal memperbarui certificate. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        try {
            $certificate = $this->certificateModel->find($id);
            
            if ($certificate) {
                // Delete image file if exists
                if (!empty($certificate['image']) && $certificate['image'] !== 'default.jpg') {
                    $imagePath = FCPATH . 'uploads/certificates/' . $certificate['image'];
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                
                $this->certificateModel->delete($id);
                return redirect()->to(base_url('admin/certificates'))->with('success', 'Certificate "' . esc($certificate['title']) . '" berhasil dihapus!');
            } else {
                return redirect()->to(base_url('admin/certificates'))->with('error', 'Certificate tidak ditemukan.');
            }
        } catch (\Throwable $e) {
            log_message('error', 'Failed to delete certificate: ' . $e->getMessage());
            return redirect()->to(base_url('admin/certificates'))->with('error', 'Gagal menghapus certificate. Silakan coba lagi.');
        }
    }
}
