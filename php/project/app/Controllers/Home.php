<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $helpers = ['form', 'cookie'];

    public function index()
    {
        $data['error'] = "";
        $session = session();
        $username = ($session->get('username')?$session->get('username'):get_cookie("username"));
        
        if ($username) {
            

            $model = new \App\Models\User_model();
            $profile = $model->getUserData($username);

            $catmodel = new \App\Models\Cat_model();
            $cats = $catmodel->get_cats();
            $data['categories'] = $cats;
            $data['error'] = "";
            $data['profile'] = $profile;

            echo view('template/header');
            echo view('home', $data);
            echo view('template/footer');
            
            return ;
        } else {
            return redirect()->to(base_url().'login');
        }
    }

    public function addCat() {
        $name = $this->request->getPost('category_name');
        $catmodel = new \App\Models\Cat_model();
        $cats = $catmodel->add_cat($name);
        return redirect()->to(base_url().'home');
        
    }
}
