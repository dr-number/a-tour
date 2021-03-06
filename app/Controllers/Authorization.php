<?php


namespace App\Controllers;

class Authorization extends BaseController {

    public function index()
    {
        helper(['form']);

        $data['title'] = "Регистрация";
        echo view('templates/header', $data);
        echo view('pages/authorization', $data);
        echo view('templates/footer', $data);
    }

    public function auth()
    {
        $session = session();
        $model = new \App\Models\UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('user_email', $email)->first();
        if($data){
            $pass = $data['user_password'];
            $verify_pass = !empty($password) && password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'user_id'       => $data['user_id'],
                    'user_name'     => $data['user_name'],
                    'user_email'    => $data['user_email'],
                    'logged_in'     => TRUE
                ];
                $session->set('data_auth', $ses_data);
                return redirect()->to('privates');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('authorization');
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('authorization');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('authorization');
    }
}
