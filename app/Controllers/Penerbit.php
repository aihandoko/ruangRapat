<?php

namespace App\Controllers;

use App\Models\PenerbitModel;

class Penerbit extends BaseController
{

    public function __construct()
    {
        $this->penerbitModel = new PenerbitModel();
    }

    public function index()
    {
        $data['title'] = 'Penerbit Index';

        //----Jika tanpa paging
        //$getPenerbit = $this->penerbitModel->getPenerbit();
        //$data['penerbit'] = $getPenerbit;

        //----Jika pakai paging
        $data['penerbit'] =  $this->penerbitModel->paginate(3,'pagerpenerbit');
        $data['pager'] =  $this->penerbitModel->pager;

        return view('/penerbit/index', $data);
    }
    
    public function detail($id='')
    {
        $data['title'] = 'Penerbit Detail';
        
        //$data['penerbit'] = $this->penerbitModel->getPenerbit($id);

        $getPenerbit = $this->penerbitModel->getPenerbit($id);

        $data['penerbit'] = $getPenerbit;

        //dd($getPenerbit);

        return view('/penerbit/detail', $data);
    }
    
    public function edit($id='')
    {
        $data['title'] = 'Penerbit Edit';
        $data['penerbit'] = $this->penerbitModel->getPenerbit($id);

        //dd( $data['penerbit'] );
        return view('/penerbit/edit', $data);
    }
    

    public function create()
    {
        $data['title'] = 'Penerbit Add';
        $data['validation'] = \Config\Services::validation();

        return view('/penerbit/create', $data);
    }


    public function add()
    {
        $request = $this->request->getVar();

        if (! $this->validate([

            'penerbit'=> [
                'rules' => 'required|is_unique[penerbit.penerbit]',
                'errors' => [
                    'required' => '{field} penerbit harus diisi',
                    'is_unique' => '{field} penerbit sudah pernah ada',
                ]
            ],

            'alamat'=> [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} penerbit harus diisi',
                ]
            ],

            'telpon'=> [
                'rules' => 'required|numeric|max_length[12]',
                'errors' => [
                    'required' => '{field} penerbit harus diisi',
                ]
            ]
            
        
            

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/penerbit/create')->withInput()->with('validation', $validation);
        }
           
        $data =[
            'penerbit'=> $request['penerbit'],
            'alamat'=> $request['alamat'],
            'telpon'=> $request['telpon'],
        ];

        //dd($data);

        $this->penerbitModel->save($data);

        session()->setFlashdata('pesan','Data berhasil ditambahkan');

        return redirect()->to('/penerbit/index');
    }


    public function editsave()
    {
        $request = $this->request->getVar();

        $data =[
            'id'=> $request['id'],
            'penerbit'=> $request['penerbit'],
            'alamat'=> $request['alamat'],
            'telpon'=> $request['telpon']
             ];

        $this->penerbitModel->save($data);

        session()->setFlashdata('pesan','Data berhasil diubah');

        return redirect()->to('/penerbit/index');
    }


    public function delete()
    {
        $request = $this->request->getVar();
        $this->penerbitModel->delete($request['id']);

        session()->setFlashdata('pesan','Data berhasil dihapus');

        return redirect()->to('/penerbit/index');
       
    }
}