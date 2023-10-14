<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    public function login($username)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);
        $query = $builder->get();
        return $query->getResult()[0]->password;
        
    }

    public function register($username, $email, $password) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);
        $builder->where('email', $email);
        $emailNusername = $builder->get();
        $builder->where('username', $username);
        $usernameCheck = $builder->get();
        $builder->where('email', $email);
        $emailCheck = $builder->get();
        if ($emailNusername->getRowArray() || $usernameCheck->getRowArray() || $emailCheck->getRowArray()) {
            return false;
        }
        else {
            $data = [
                'username' => $username,
                'password' => $password,
                'email' => $email
            ];
            $builder->insert($data);
            return true;
        }
    }

    public function getUserData($username) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);

        $profile = $builder->get();

        foreach ($profile->getResult('array') as $row) {
            return $row;
        }
    }

    public function updateUserProfile($updateProfile) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $updateProfile['username']);
        $builder->update($updateProfile);
        return;
    }

    public function getPFP($username) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);
        $profile = $builder->get();
        return $profile->getResult('array')[0]['pfp_filename'];
    }

    public function getCount($user_id, $table) {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->where('user_id', $user_id);
        
        return $builder->countAllResults();
    }

    public function updatePassword($username, $password) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->set('password', $password);
        $builder->where('username', $username);
        $builder->update();
        return;
    }

    public function findEmail($email) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('email', $email);
        $profile = $builder->get();
        if ($profile->getResult('array')) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    public function changePasswordEmail($email, $password) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->set('password', $password);
        $builder->where('email', $email);
        $builder->update();
        return;
    }
}