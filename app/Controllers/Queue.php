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


	// tampilkan list yg sudah ACC //////////////////////////////////////////////////////
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


	// tampilkan list yg blm ACC  //////////////////////////////////////////////////////
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

	// tampilkan report peminjaman  //////////////////////////////////////////////////////
	public function laporan()
	{
		$request = $this->request->getVar();
		if( isset($request['dari']) && isset($request['sd']) ) {
			$dari = $request['dari'];
			$sd = $request['sd'];
		} else {
			$dari = date('m-01-Y'); 
			$sd = date('m-t-Y');
		}

		$data = $this->model->getReport($dari, $sd);

		return view('Queue/report', [
			'page_title' => 'Laporan',
			'auth' => $this->auth,
			'pinjam' => $data,
			'tgl1' => $dari,
			'tgl2' => $sd
		]);
	}

	// tampilkan detil peminjaman  //////////////////////////////////////////////////////
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


	// acc peminjaman   //////////////////////////////////////////////////////
	public function acc() 
	{
		$request = $this->request->getVar();
		$data = $this->model->accPinjam($request['no']);
		
		session()->setFlashdata('pesan','Persetujuan Peminjaman Berhasil');
        return redirect()->to('Queue/antrian');
	}
	

	// penolakan peminjaman   //////////////////////////////////////////////////////
	public function tolak() 
	{
		$request = $this->request->getVar();
		$data = $this->model->batalPinjam($request['no']);
		
		session()->setFlashdata('pesan','Penolakan Peminjaman Berhasil');
        return redirect()->to('Queue/antrian');
	}


	// batalkan peminjaman   //////////////////////////////////////////////////////
	public function batal() 
	{
		$request = $this->request->getVar();
		$data = $this->model->batalPinjam($request['no']);
		
		session()->setFlashdata('pesan','Pembatalan Peminjaman Berhasil');
        return redirect()->to('Queue/index');
	}


	// form input   //////////////////////////////////////////////////////
	public function input()
    {
		//$data = $this->model->getList('-');
		$data['validation'] = \Config\Services::validation();
		//dd ($data);
		return view('Queue/formInput', [
			'page_title' => 'Form Input',
			'auth' => $this->auth,
			'pinjam' => $data,
			'validation' =>$data['validation'],
		]);
    }


}