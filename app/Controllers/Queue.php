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

	// tampilkan list yg sudah ACC
	public function index() 
	{
        $data = $this->model->getList('S');
		//dd ($data);
		return view('Queue/main', [
			'page_title' => 'Jadwal',
			'auth' => $this->auth,
			'pinjam' => $data
		]);
	}


	// tampilkan list yg blm ACC
	public function antrian() 
	{
        $data = $this->model->getList('-');
		//dd ($data);
		return view('Queue/antrian', [
			'page_title' => 'Antrian',
			'auth' => $this->auth,
			'pinjam' => $data
		]);
	}

	// tampilkan detil peminjaman
	public function detil($no) 
	{
        $data = $this->model->getPinjam($no);
		//dd ($data);
		return view('Queue/detil', [
			'page_title' => 'Detil',
			'auth' => $this->auth,
			'pinjam' => $data
		]);
	}


	// form input
	public function input()
    {
		$data = $this->model->getList('-');
		//dd ($data);
		return view('Queue/input', [
			'page_title' => 'Form Input',
			'auth' => $this->auth,
			'pinjam' => $data
		]);

		
    }


    

}