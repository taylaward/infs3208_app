<?php

namespace App\Models;

use CodeIgniter\Model;

class Email_Model extends Model
{
    public function makeToken($email) {
        $db = \Config\Database::connect();
        $builder = $db->table('email_auth');
        
        $data = [
            'email' => $email,
            'token' => bin2hex(random_bytes(16))
        ];
        $builder->insert($data);
        return true;
    }

    public function isValid($email) {
        $db = \Config\Database::connect();
        $builder = $db->table('email_auth');
        $builder->where('email', $email);
        foreach ($builder->get()->getResult() as $row) {
            if ($row->validated) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function getToken($email) {
        $db = \Config\Database::connect();
        $builder = $db->table('email_auth');
        $builder->where('email', $email);
        foreach ($builder->get()->getResult() as $row) {
            return $row->token;
        }
    }

    public function validateToken($token) {
        $db = \Config\Database::connect();
        $builder = $db->table('email_auth');
        $builder->where('token', $token);
        
        foreach ($builder->get()->getResult() as $row) {
            $builder->set('validated', TRUE);
            $builder->update();
            return TRUE;
        } 
        
        return FALSE;
        
    }
}