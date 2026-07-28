<?php

namespace App\Controllers;

class Contact extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Admin Faiq | Data Scientist & AI Developer Portofolio'
        ];
        return view('admin/contacts', $data);
    }
}
