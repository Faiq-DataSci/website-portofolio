<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Faiq | Data Scientist & AI Developer Portofolio'
        ];
        return view('home/index', $data);
    }
}
