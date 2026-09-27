<?php

namespace App\Controllers;

class Admin extends BaseController
{
    protected $db, $builder; 

    function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    
    public function index(): string
    {
        $this->builder = $this->db->table('users');
        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

        $query = $this->builder->get();
        $data['users'] = $query->getResultObject();

        // $query = $this->db->query('SELECT * FROM akun1s');
        // $data['dtakun1'] = $query->getResult();
        return view('admin/index', $data);
    }

    public function detail($id)
    {
        $this->builder = $this->db->table('users');
        $this->builder->select('users.id as userid, username, email, name, fullname, gbr');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

        $this->builder->where('users.id', $id);

        $query = $this->builder->get();
        $data['user'] = $query->getRow();

        // $query = $this->db->query('SELECT * FROM akun1s');
        // $data['dtakun1'] = $query->getResult();
        return view('admin/detail', $data);
    }
}
