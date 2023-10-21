<?php

namespace App\Controllers;

use CodeIgniter\Email\Email;

class Login extends BaseController
{
    protected $helpers = ['form', 'cookie'];

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
                echo view('login', $data);
                echo view('template/footer');
            }
        }
    }

    public function check_login() {
        $data['error'] = "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or password!! </div> ";
        $username = $this->request->getPost('username');
        $model = new \App\Models\User_model();
        $check = $model->login($username);
        $if_remember = $this->request->getPost('remember');

        if (isset($check) && password_verify($this->request->getPost('password'), $check)) {
            // Clear old cookies
            setcookie('username', "", time() - 3600, "/");
            setcookie('password', "", time() - 3600, "/");
            # Create a session
            $session = session();
            $session->set('username', $username);
            $session->set('loggedIn', TRUE);
            if ($if_remember) {
                # Create a cookie
                setcookie('username', $username, time() + (86400 * 30), "/");
            }
            echo view('template/header');
            echo view("welcome_message");
            echo view('template/footer');
        } else {
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }

    public function forgotPasswordPage() {
        echo view('template/header');
        echo view('forgotPasswordEmail');
        echo view('template/footer');
    }

    public function getCode() {
        $model = new \App\Models\User_model();
        $check = $model->findEmail($this->request->getPost('email'));
        if ($check) {
            $code = random_int(100000, 999999);
            $email = new Email();
            $emailConf = [
                'protocol' => 'smtp',
                'wordWrap' => true,
                'SMTPHost' => 'mailhub.eait.uq.edu.au',
                'SMTPPort' => 25
            ];
            $email->initialize($emailConf);
            $email->setTo($this->request->getPost('email'));
            $email->setFrom('infs3202-32976b81@uqcloud.net');
            $email->setSubject('Password Reset Request');
            $email->setMessage("Password Reset Request Recieved
Your code is: " . $code ."
This is an automatic email. Please disregard if you did not request a password change.");

            if($email->send()) {
                $session = session();
                $session->set('code', $code);
                $session->set('email', $this->request->getPost('email'));

                echo view('template/header');
                echo view('getCode');
                echo view('template/footer');
            } else {
                $data['error'] = "Reset email failed to send. Please try again!";
                echo view('template/header');
                echo view('login', $data);
                echo view('template/footer');
            }
        } else {
            $data['error'] = "Email does not exist in the system.";
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }
    }

    public function checkCode() {
        $session = session();
        $code = $session->get('code');
        if ($this->request->getPost('code') == $code) {
            $data['error'] = "";
            echo view('template/header');
            echo view('forgotPasswordInput', $data);
            echo view('template/footer');
        } else {
            $data['error'] = "Wrong code.";
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }

    }

    public function changePassword() {
        $rules = [
            'password' => 'required|min_length[10]',
            'passwordCheck' => 'required|matches[password]'
        ];

        if (! $this->validate($rules)) {
            $data['error'] = "";
            echo view('template/header');
            echo view('forgotPasswordInput', $data);
            echo view('template/footer');
            return;
        }

        $session = session();
        $email = $session->get('email');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $model = new \App\Models\User_model();
        $check = $model->changePasswordEmail($email, $password);
        
        $session->destroy();
        return redirect()->to(base_url().'login');

    }

}