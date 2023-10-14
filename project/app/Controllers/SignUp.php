<?php

namespace App\Controllers;

use Config\Services;
use CodeIgniter\Email\Email;

class SignUp extends BaseController
{
    protected $helpers = ['form'];

    public function index() {
        $data['error'] = "";
        if (isset($_COOKIE['username']) && isset($_COOKIE['password']) ) {
            echo view('template/header');
            echo view("welcome_message");
            echo view('template/footer');
        } else {
            $session = session();
            $username = $session->get('username');
            if ($username) {
                echo view('template/header');
                echo view("welcome_message");
                echo view('template/footer');
            } else {
                echo view('template/header');
                echo view('signup', $data);
                echo view('template/footer');
            }
        }
    }

    public function register() {
        $data['error'] = "<div class=\"alert alert-danger\" role=\"alert\"> Username or Email already in our system! </div> ";
        
        if (strtolower($this->request->getMethod()) !== 'post') {
            $data['error'] = "";
            echo view('template/header');
            echo view('signup', $data);
            echo view('template/footer');
            return;
        }

        $rules = [
            'username' => 'required',
            'password' => 'required|min_length[10]',
            'passwordCheck' => 'required|matches[password]',
            'email' => 'required|valid_email',
        ];

        if (! $this->validate($rules)) {
            $data['error'] = "";
            echo view('template/header');
            echo view('signup', $data);
            echo view('template/footer');
            return;
        }
        
        $username = $this->request->getPost('username');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $email = $this->request->getPost('email');

        $model = new \App\Models\User_model();
        $check = $model->register($username, $email, $password);

        

        if ($check) {
            # Create a session
            $emailModel = new \App\Models\Email_Model();
            $emailModel->makeToken($email);
            $this->verifyEmail($email);
            $session = session();
            $session->set('username', $username);
            return redirect()->to(base_url());
        } else {
            $data['error'] = "Unexpected Error.";
            echo view('template/header');
            echo view('signup', $data);
            echo view('template/footer');
        }
    }

    public function reVerify() {
        $session = session();
        $profile = $session->get('profile');
        $this->verifyEmail($profile['email']);
        return redirect()->back();

    }

    private function verifyEmail($emailAddr) {
        $emailModel = new \App\Models\Email_Model();
        $token = $emailModel->getToken($emailAddr);
        $email = new Email();
            $emailConf = [
                'protocol' => 'smtp',
                'wordWrap' => true,
                'SMTPHost' => 'mailhub.eait.uq.edu.au',
                'SMTPPort' => 25
            ];
            $email->initialize($emailConf);
            $email->setTo($emailAddr);
            $email->setFrom('infs3202-32976b81@uqcloud.net');
            $email->setSubject('Verify Email');
            $email->setMessage(
"Please verify your email.

Follow this link in your browser:
https://infs3202-32976b81.uqcloud.net/project/signup/confirmEmail?token=".$token."

This is an automatic email. Please disregard if you did not request a password change.");

            $email->send();
    }

    public function confirmEmail() {
        $token = $_GET["token"];
        $emailModel = new \App\Models\Email_Model();
        $check = $emailModel->validateToken($token);
        if ($check) {
            echo view('template/header');
            echo view("emailConfirmation");
            echo view('template/footer');
        } else {
            return redirect()->to(base_url().'login');
        }
    }


}