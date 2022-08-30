<?php

namespace App\Controllers;

use App\Models\PinjamModel;
use App\Libraries\Common;
use CodeIgniter\I18n\Time;

class Pinjam extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new PinjamModel();
    }

    public function add()
    {
        $request = $this->request->getVar();
		//dd($request);

        // validate //////////////////////////////////////////////////////
        if (! $this->validate([
			'bag'=> [
                'rules' => 'required|min_length[2]',
                'errors' => [
                    'required' => 'Silakan Pilih Bagian',
                ]
            ],

			'ruang'=> [
                'rules' => 'required|min_length[2]',
                'errors' => [
                    'required' => 'Silakan Pilih Ruang',
                ]
            ],

			'peserta'=> [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silakan isi Jumlah Peserta',
                ]
            ],
			
			'tgl'=> [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silakan Pilih Tanggal',
                ]
            ],

			'mulai'=> [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silakan isi Jam Mulai',
                ]
            ],

			'selesai'=> [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silakan isi Jam Selesai',
                ]
            ],

			'acara'=> [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silakan isi Acara',
                ]
            ],
		
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/Queue/input')->withInput()->with('pesan', $validation->listErrors() );
        }
           
        // get checkbox //////////////////////////////////////////////////////
        if( isset( $request['ohp'] ) ) 
        {
            $ohp = 1 ;
        } else {
            $ohp = 0 ;
        }

        if( isset( $request['lcd'] ) ) 
        {
            $lcd = 1 ;
        } else {
            $lcd = 0 ;
        }
        
        if( isset( $request['wboard'] ) ) 
        {
            $wboard = 1 ;
        } else {
            $wboard = 0 ;
        }

        if( isset( $request['flip'] ) ) 
        {
            $flip = 1 ;
        } else {
            $flip = 0 ;
        }

        if( isset( $request['mic'] ) ) 
        {
            $mic = 1 ;
        } else {
            $mic = 0 ;
        }
        
        if( isset( $request['air'] ) ) 
        {
            $air = 1 ;
        } else {
            $air = 0 ;
        }

        if( isset( $request['teh'] ) ) 
        {
            $teh = 1 ;
        } else {
            $teh = 0 ;
        }

        if( isset( $request['kopi'] ) ) 
        {
            $kopi = 1 ;
        } else {
            $kopi = 0 ;
        }
        
        if( isset( $request['gula'] ) ) 
        {
            $gula = 1 ;
        } else {
            $gula = 0 ;
        }

        if( isset( $request['creamer'] ) ) 
        {
            $creamer = 1 ;
        } else {
            $creamer = 0 ;
        }

        if( isset( $request['kue'] ) ) 
        {
            $kue = 1 ;
        } else {
            $kue = 0 ;
        }
        
        if( isset( $request['lunch'] ) ) 
        {
            $lunch = 1 ;
        } else {
            $lunch = 0 ;
        }

        // store data //////////////////////////////////////////////////////
        $data =[
            'bag' => $request['bag'],
            'ruang' => $request['ruang'],
            'acara' => $request['acara'],
            'peserta' => $request['peserta'],
            'ohp' => $ohp,
            'lcd' => $lcd,
            'wboard' => $wboard,
            'flip' => $flip,
            'mic' => $mic,
            'air' => $air,
            'teh' => $teh,
            'kopi' => $kopi,
            'gula' => $gula,
            'creamer' => $creamer,
            'kue' => $kue,
            'lunch' => $lunch,
            'meja' => $request['meja'],
            'ket' => $request['ket'],
            'peminjam' => session()->get('NIK'),
            'tgl' => $request['tgl'],
            'mulai' => $request['mulai'],
            'selesai' => $request['selesai'],
            //'durasi' => $request['durasi'],
            'inex' => $request['inex'],
        ];

        //dd($data);

        $this->model->save($data);
        session()->setFlashdata('pesan','Pengajuan Peminjaman Berhasil');
        return redirect()->to('/queue/antrian');
    }






    

}