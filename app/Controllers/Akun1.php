<?php

namespace App\Controllers;

class Akun1 extends BaseController
{
    public function index(): string
    {
        $builder = $this->db->table('akun1s');
        $query = $builder->get();

        $query = $this->db->query('SELECT * FROM akun1s');
        $data['dtakun1'] = $query->getResult();
        return view('akun1/index', $data);

        // dd($query);
    }
}
