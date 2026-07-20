<?php

namespace App\Controllers;

class Projects extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Faiq | Projects Portofolio'
        ];
        return view('projects/index', $data);
    }
}
