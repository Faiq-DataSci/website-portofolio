<?php

namespace App\Controllers;

class Contact extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Faiq | Contact Portofolio'
        ];
        return view('contact/index', $data);
    }
}
