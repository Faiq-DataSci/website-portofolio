<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Admin Faiq | Data Scientist & AI Developer Portofolio'
        ];
        return view('admin/dashboard', $data);
    }
}
