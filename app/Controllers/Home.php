<?php


namespace App\Controllers;

class Home extends BaseController {

        public function index()
        {
            //route_to('publics');
            //echo view('templates/footer');

            $session = session();
            if($session->has('data_auth') && $session->get('data_auth')['logged_in'])
                return redirect()->to('privates');
            else
                return redirect()->to('authorization');
        }
    }
