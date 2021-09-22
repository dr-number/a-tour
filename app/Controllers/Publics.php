<?php

namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException;

class Publics extends BaseController
{
    public function index($page = 'publics')
    {
        if (!is_file(APPPATH . '/Views/pages/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }

        $data['title'] = "Гость";

        echo view('templates/header', $data);
        echo view('pages/' . $page, $data);
        echo view('templates/footer', $data);
    }
}

