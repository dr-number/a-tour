<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Privates extends BaseController
{
    public function index($page = 'privates')
    {
        $session = session();
        $is_auth = $session->has('data_auth') && $session->get('data_auth')['logged_in'];

        if(!$is_auth){
            $session->setFlashdata('msg', 'Доступ закрыт! Вы не автризированы!');
            return redirect()->to('authorization');
        }

        if (!is_file(APPPATH . '/Views/pages/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }

        $data['title'] = "Авторизированный пользователь";

        $session = session();
        $session_data = $session->get('data_auth');
        $data['user_email'] = $session_data['user_email'];

        $model = new \App\Models\UserModel();
        $data['users'] = $model->get_all_data();


        echo view('templates/header', $data);
        echo view('pages/' . $page, $data);
        echo view('templates/footer', $data);
    }
}

