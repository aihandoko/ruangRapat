<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Libraries\Breadcrumbs;

class Users extends BaseController
{
	public function index()
	{
		return view('Users/main', [
            'page_title' => 'Users',
			'functions' => $this->getFungsi(),
			'auth' => $this->auth
		]);
	}

    public function create()
    {
        $this->breadcrumbs->add('<i class="fas fa-home"></i>', '/');
        $this->breadcrumbs->add('Users', '/users');
        $this->breadcrumbs->add('Create', '/users/create');

        return view('Users/create', [
            'page_title' => 'Tambah user',
            'user_fungsi' => $this->getUsersFungsi(),
            'functions' => $this->getFungsi(),
            'auth' => $this->auth,
            'breadcrumbs' => $this->breadcrumbs->render(),
        ]);
    }

    public function edit()
    {
        $nik = $this->base64urlDecode($this->request->getGet('nik'));
        $nama = $this->base64urlDecode($this->request->getGet('nama'));
        $fungsi = $this->base64urlDecode($this->request->getGet('fungsi'));
        $site = $this->base64urlDecode($this->request->getGet('site'));
        $model = new UsersModel();
        $query = $model->getByParams($nik, $nama, $fungsi, $site);
        $data = [];
        $input_hidden = [];
        foreach ($query->getResult() as $key => $row) {
            $input_hidden = [
                'NIK' => $row->NIK,
                'Nama' => $row->Nama,
                'Fungsi' => $row->Fungsi,
                'Site' => $row->Site
            ];
            $data = [
                'NIK' => $row->NIK,
                'Nama' => $row->Nama,
                'Fungsi' => $row->Fungsi,
                'Site' => $row->Site,
                'KodeSPMB' => $row->KodeSPMB,
                'CompId' => $row->CompId,
                'DeptId' => $row->DeptId
            ];
        }
        return view('Users/edit', [
            'page_title' => 'Edit user',
            'user_fungsi' => $this->getUsersFungsi(),
            'functions' => $this->getFungsi(),
            'auth' => $this->auth,
            'data' => $data,
            'input_hidden' => $input_hidden
        ]);
    }

    public function delete()
    {
        $nik = $this->base64urlDecode($this->request->getGet('nik'));
        $nama = $this->base64urlDecode($this->request->getGet('nama'));
        $fungsi = $this->base64urlDecode($this->request->getGet('fungsi'));
        $site = $this->base64urlDecode($this->request->getGet('site'));

        if((new UsersModel())->destroy($nik, $nama, $fungsi, $site)) {
            return redirect()->to('users')
                        ->with('success', 'Data user berhasil di hapus.');
        } else {
            return redirect()->back()
                        ->with('error', 'Data user gagal di hapus.');
        }
    }

	public function apiGetAll()
	{
        if($this->request->getMethod() != 'post') {
            return redirect()->to('/');
        }

		// if( ! $dataUsers = cache('dataUsers')) {

            $dataUsers = (new UsersModel())->findAll();

        //     cache()->save('dataUsers', $dataUsers, 1200);
        // }

        $arrData = [];
        foreach ($dataUsers as $key => $val) {
            $nik_enc = $this->base64urlEncode($val['NIK']);
            $nama_enc = $this->base64urlEncode($val['Nama']);
            $fungsi_enc = ($val['Fungsi'] != null) ? $this->base64urlEncode($val['Fungsi']) : $this->base64urlEncode('null');
            $site_enc = ($val['Site'] != null) ? $this->base64urlEncode($val['Site']) : $this->base64urlEncode('null');
            $edit = '<a href="' . site_url('users/edit?nik=' . $nik_enc . '&nama=' . $nama_enc . '&fungsi=' . $fungsi_enc . '&site=' . $site_enc) . '" title="Edit"><i class="far fa-edit"></i></a> ';
            $hapus = '<a href="' . site_url('users/delete?nik=' . $nik_enc . '&nama=' . $nama_enc . '&fungsi=' . $fungsi_enc . '&site=' . $site_enc) . '" onclick="return confirm(\'Apa Anda yakin menghapus user ini?\')" title="Delete"><i class="fas fa-trash-alt"></i></a>';
            $arrData[] = [
                $key + 1,
                $val['NIK'] ?? '&nbsp;',
                $val['Nama'] ?? '&nbsp;',
                $val['Fungsi'] ?? '&nbsp;',
                $val['Site'] ?? '&nbsp;',
                ($val['KodeSPMB'] != null) ? '<div class="kodespmb-wrapper">' . $val['KodeSPMB'] . '</div>' : '&nbsp;',
                $val['CompId'] ?? '&nbsp;',
                ($val['DeptId'] != null) ? '<div class="dept-id-wrapper">' . $val['DeptId'] . '</div>' : '&nbsp;',
                $edit . $hapus,
            ];
        }

        $response = $arrData;

        return $this->response->setJSON($response);
	}

    public function addProcess()
    {
        if($this->request->getMethod() != 'post') {
            return redirect()->to('/');
        }

        $nik = $this->request->getPost('nik');
        $nama = $this->request->getPost('nama');
        $fungsi = $this->request->getPost('fungsi');
        $site = $this->request->getPost('site');

        $data = [
            'NIK' => $nik,
            'Nama' => $nama,
            'Fungsi' => $fungsi,
            'Site' => $site,
            'KodeSPMB' => $this->request->getPost('KodeSPMB'),
            'DeptId' => $this->request->getPost('deptid'),
            'CompId' => $this->request->getPost('compid')
        ];

        $model = new UsersModel();

        if( ! $model->validate($data) ) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', '<p>' . implode('</p><p>', $model->errors()) . '</p>');
        }

        if($model->getByParams($nik, $nama, $fungsi, $site)->getNumRows() > 0) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Data dengan NIK=' . $nik . ', Nama='. $nama . ', Fungsi='. $fungsi . ', Site='. $site . ' sudah exist di database.');
        }

        if( $model->insert($data, false) ) {
            return redirect()->to('users')
                            ->with('success', 'Data user berhasil ditambahkan.');
        }

        return redirect()->back()
                        ->withInput()
                        ->with('error', 'Terjadi kesalahan.');
    }

    public function editProcess()
    {
        if($this->request->getMethod() != 'post') {
            return redirect()->to('/');
        }

        $params = [
            'NIK' => $this->request->getPost('NIK'),
            'Nama' => $this->request->getPost('Nama'),
            'Fungsi' => $this->request->getPost('Fungsi'),
            'Site' => $this->request->getPost('Site')
        ];

        $nik = $this->request->getPost('nik');
        $nama = $this->request->getPost('nama');
        $fungsi = $this->request->getPost('fungsi');
        $site = $this->request->getPost('site');

        $data = [
            'NIK' => $nik,
            'Nama' => $nama,
            'Fungsi' => $fungsi,
            'Site' => $site,
            'KodeSPMB' => $this->request->getPost('KodeSPMB'),
            'DeptId' => $this->request->getPost('deptid'),
            'CompId' => $this->request->getPost('compid')
        ];

        $model = new UsersModel();

        if( ! $model->validate($data) ) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', '<p>' . implode('</p><p>', $model->errors()) . '</p>');
        }

        if( $model->getByParams($nik, $nama, $fungsi, $site)->getNumRows() > 0 &&
            ($nik !== $this->request->getPost('NIK') ||
                $nama !== $this->request->getPost('Nama') ||
                $fungsi !== $this->request->getPost('Fungsi') ||
                $site !== $this->request->getPost('Site')
            )
        ) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Data dengan NIK=' . $nik . ', Nama='. $nama . ', Fungsi='. $fungsi . ', Site='. $site . ' sudah exist di database.');
        }

        if( $model->updateByParams($params, $data) ) {
            return redirect()->to('users')
                            ->with('success', 'Data user berhasil diupdate.');
        }

        return redirect()->back()
                        ->withInput()
                        ->with('error', 'Terjadi kesalahan.');
    }

    private function getUsersFungsi()
    {
        $model = new UsersModel;

        $data = [];
        if($model->getFungsi()->getNumRows() > 0) {
            foreach($model->getFungsi()->getResult() as $row) {
                $data[] = $row->Fungsi;
            }
        }
        $sites = [];
        if($model->getSites()->getNumRows() > 0) {
            foreach($model->getSites()->getResult() as $row) {
                $sites[] = $row->Site;
            }
        }

        return [
            'fungsi' => $data,
            'sites' => $sites
        ];
    }

    private function base64urlEncode(string $text): string
    {
        return str_replace(
            ["+", "/", "="],
            ["-", "_", ""],
            base64_encode($text)
        );
    }

    private function base64urlDecode(string $text): string
    {
        return base64_decode(str_replace(
            ["-", "_"],
            ["+", "/"],
            $text)
        );
    }
}