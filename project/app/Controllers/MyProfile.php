<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class MyProfile extends BaseController
{
    protected $helpers = ['form', 'cookie'];

    public function index() {
        $data['error'] = "";
        $session = session();
        $username = ($session->get('username')?$session->get('username'):get_cookie("username"));
        
        if ($username) {
            $model = new \App\Models\User_model();
            $emailValid = new \App\Models\Email_Model();
            $profile = $model->getUserData($username);
            $data['valid'] = $emailValid->isValid($profile['email']);
            $data['profile'] = $profile;
            $data['post_data'] = [
                'numPosts' => $model->getCount($profile['user_id'], 'posts'),
                'numReplies' => $model->getCount($profile['user_id'], 'replies')
            ];
            $session->set('profile', $profile);
            echo view('template/header');
            echo view("myprofile", $data);
            echo view('template/footer');
        } else {
            return redirect()->to(base_url().'login');
        }
    }


    public function updateProfile() {
        $data['error'] = "";

        $validateImg = $this->validate([
            'image' => 'uploaded[image]|max_size[image,4096]|ext_in[image,jpeg,png,jpg,gif]|permit_empty'
        ]);

        // Set up profile info
        $session = session();
        $username = $session->get('username');
        $model = new \App\Models\User_model();
        $profile = $model->getUserData($username);
        $data['profile'] = $profile;

        // Rules not validated
        if (!$validateImg) {
            $data['error'] = "";
            echo view('template/header');
            echo view('myprofile', $data);
            echo view('template/footer');
            return;
        }
        
        // Get all info from the edit profile form
        $firstName = $this->request->getPost('firstName');
        $lastName = $this->request->getPost('lastName');
        $email = $this->request->getPost('email');
        $mobile = $this->request->getPost('mobileNumber');
        // This is from my image upload form
        $image = $this->request->getFile('image');

        // Init user model to access database functions
        $model = new \App\Models\User_model();

        // If 'image' form component contains data i.e. the user uploaded an image
        if ($image != "") {

            // Delete old image, by getting the saved pfp from user table
            $oldName = $model->getPFP($username);

            //Unlink deletes the file
            @unlink('/var/www/htdocs'.$oldName);

            // Prep image for saving
            // Make new random name
            $newName = $image->getRandomName();
            // Save and resize image, I chose 250 x 250 cause it works with my layout
            $imageModel = \Config\Services::image()->withFile($image)->resize(250, 250, true, 'height')
                                ->save('/var/www/htdocs/project/writable/pfp/'.$newName);
            
            // Set up array to be given to the user model class to update profile information
            $updateUserProfile = [
                'username' => $username,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'mobile_number' => $mobile,
                'pfp_filename' => '/project/writable/pfp/'.$newName
            ];
        } else {
            $updateUserProfile = [
                'username' => $username,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'mobile_number' => $mobile
            ];
        }
        

        // Set up model connection
        
        // Send data to model
        $model->updateUserProfile($updateUserProfile);
        
        // Get updated user data
        $profile = $model->getUserData($username);
        $data['profile'] = $profile;
        $session->set('profile', $profile);
        

        $data['post_data'] = [
            'numPosts' => $model->getCount($profile['user_id'], 'posts'),
            'numReplies' => $model->getCount($profile['user_id'], 'replies')
        ];

        return redirect()->to(base_url().'myprofile');
    
    }

    public function resetPassword() {
        $data['error'] = "";
        echo view('template/header');
        echo view("resetPassword", $data);
        echo view('template/footer');
        
    }

    public function changePassword() {
        $rules = [
            'currentPassword' => 'required',
            'newPassword' => 'required|min_length[10]',
            'checkPassword' => 'required|matches[newPassword]',
        ];

        if (! $this->validate($rules)) {
            $data['error'] = "";
            echo view('template/header');
            echo view('resetPassword', $data);
            echo view('template/footer');
            return;
        }

        $currentPassword = $this->request->getPost('currentPassword');
        $newPassword = $this->request->getPost('newPassword');

        $session = session();
        $username = $session->get('username');

        $model = new \App\Models\User_model();
        $check = $model->login($username);

        if (isset($check) && password_verify($this->request->getPost('currentPassword'), $check)) {
            $profile = $model->getUserData($username);
            $data['profile'] = $profile;
            $model->updatePassword($username, password_hash($newPassword, PASSWORD_DEFAULT));
            
            return redirect()->to(base_url().'myprofile');
        } else {
            $data['error'] = "You entered the wrong password!";
            echo view('template/header');
            echo view('resetPassword', $data);
            echo view('template/footer');
            return;
        }
    }

    public function resetSecQuestion() {
        $data['error'] = "";
        echo view('template/header');
        echo view("resetPassword", $data);
        echo view('template/footer');
        
    }
} 