<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Faiq | About Portofolio'
        ];
        return view('About/index', $data);
    }
}
