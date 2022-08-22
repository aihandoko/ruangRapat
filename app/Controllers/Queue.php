<?php

namespace App\Controllers;

use App\Models\PinjamModel;
use App\Libraries\Common;
use CodeIgniter\I18n\Time;

class Queue extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new PinjamModel();
    }

	// JADWAL - tampilkan yg sudah ACC
	public function index() 
	{
        $data = $this->model->getPinjam('S');
		//dd ($data);
		return view('Queue/main', [
			'page_title' => 'Jadwal',
			'auth' => $this->auth,
			'pinjam' => $data
		]);
	}

	// ANTRIAN - tampilkan yg blm ACC
	public function antrian() 
	{
        $data = $this->model->getPinjam('-');
		//dd ($data);
		return view('Queue/antrian', [
			'page_title' => 'Antrian',
			'auth' => $this->auth,
			'pinjam' => $data
		]);
	}



    

}