<?php

namespace App\Controllers;

class Registration extends BaseController {

    /*
    public function index($page = 'authorization')
    {

        if (!is_file(APPPATH . '/Views/pages/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }

        $data['title'] = "Регистрация";

        echo view('templates/header', $data);
        echo view('pages/' . $page, $data);
        echo view('templates/footer', $data);
    }
    */

    public function index()
    {
        //include helper form
        helper(['form']);


        $data['title'] = "Регистрация";
        echo view('templates/header', $data);
        echo view('pages/registration', $data);
        echo view('templates/footer', $data);
    }

    public function save()
    {
        $session = session();

        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'name'          => 'required|min_length[3]|max_length[20]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.user_email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];

        if($this->validate($rules)){
            $model = new \App\Models\UserModel();
            $data = [
                'user_name'     => $this->request->getVar('name'),
                'user_email'    => $this->request->getVar('email'),
                'user_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];

            $user_id = $model->insert_data($data);
            $data['validation'] = $this->validator;

            $ses_data = [
                'user_id'       => $user_id,
                'user_name'     => $data['user_name'],
                'user_email'    => $data['user_email'],
                'logged_in'     => TRUE
            ];
            $session->set('data_auth', $ses_data);

            return redirect()->to('privates');
        }else{

            $errors = $this->validator->getErrors();
            $data['title'] = "Регистрация";
            $data['errors'] = $errors;

            //$session->setFlashdata('msg', 'Wrong Password');

            echo view('templates/header', $data);
            echo view('pages/registration', $data);
            echo view('templates/footer', $data);
        }

    }
}
