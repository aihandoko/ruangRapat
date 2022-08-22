<?php

namespace App\Controllers;

use App\Models\PinjamModel;

class Pinjam extends BaseController
{

    public function __construct()
    {
        $this->pinjamModel = new PinjamModel();
    }

    public function index()
    {
        $data['title'] = 'Index';

        $getPinjam = $this->pinjamModel->getPinjam('B');
        $data['pinjam'] = $getPinjam;

        return view('/pinjam/index', $data);
    }
    

}