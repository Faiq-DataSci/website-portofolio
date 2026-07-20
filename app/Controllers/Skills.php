<?php

namespace App\Controllers;

class Skills extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Faiq | Skills Portofolio'
        ];
        return view('Skills/index', $data);
    }
}
