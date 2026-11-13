<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('pages/home', [
            'title'       => 'Home',
            'description' => 'A CodeIgniter 4 and Tailwind CSS starter.',
        ]);
    }
}
