<?php

namespace App\Models;

use CodeIgniter\Model;

class Cat_model extends Model
{
    public function get_cats() {
        $db = \Config\Database::connect();
        $builder = $db->table('categories');
        return $builder->get()->getResult('array');
    }

    public function add_cat($name) {
        $db = \Config\Database::connect();
        $builder = $db->table('categories');
        $builder->where('name', $name);
        if ($builder->get()->getResult()) {
            return false;
        }
        $data = [
            'name' => $name
        ];
        $builder->insert($data);
        return true;
    }
}

?>