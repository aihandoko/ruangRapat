<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Libraries\Breadcrumbs;
use App\Libraries\Common;

class Users extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new UsersModel();
    }

	/**
     * Method index yang ditampilkan /users
     * 
     * @return \CodeIgniter\View\View
     */
    public function index()
	{
        $this->breadcrumbs->add('<i class="fas fa-home"></i>', '/');
        $this->breadcrumbs->add('Users', '/users');

		return view('Users/main', [
            'page_title' => 'Users',
			'auth' => $this->auth,
            'breadcrumbs' => $this->breadcrumbs->render(),
		]);
	}

    /**
     * Method yang menampilkan halaman CREATE USER /users/create
     * 
     * @return \CodeIgniter\View\View
     */
    public function create()
    {
        $this->breadcrumbs->add('<i class="fas fa-home"></i>', '/');
        $this->breadcrumbs->add('Users', '/users');
        $this->breadcrumbs->add('Create', '/users/create');

        return view('Users/create', [
            'page_title' => 'Tambah user',
            'user_fungsi' => $this->getUsersFungsi(),
            'auth' => $this->auth,
            'breadcrumbs' => $this->breadcrumbs->render(),
        ]);
    }

    /**
     * Method yang menampilkan halaman EDIT USER /users/edit?
     * 
     * @param string  @nik
     * @param string  @nama
     * @param string  @fungsi
     * @param string  @site
     *
     * @return \CodeIgniter\View\View
     */
    public function edit()
    {
        $this->breadcrumbs->add('<i class="fas fa-home"></i>', '/');
        $this->breadcrumbs->add('Users', '/users');
        $this->breadcrumbs->add('Edit', '/users/edit');

        $str_encoder = new Common();

        $nik = $str_encoder->base64urlDecode($this->request->getGet('nik'));
        $nama = $str_encoder->base64urlDecode($this->request->getGet('nama'));
        $fungsi = $str_encoder->base64urlDecode($this->request->getGet('fungsi'));
        $site = $str_encoder->base64urlDecode($this->request->getGet('site'));

        $query = $this->model->getByParams($nik, $nama, $fungsi, $site);

        $data = [];
        $input_hidden = [];
        foreach ($query->getResult() as $key => $row) {
            $input_hidden = [
                'NIK' => $row->NIK,
                'Nama' => $row->Nama,
                'Fungsi' => $row->Fungsi ?? '',
                'Site' => $row->Site ?? ''
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
            'auth' => $this->auth,
            'data' => $data,
            'input_hidden' => $input_hidden,
            'breadcrumbs' => $this->breadcrumbs->render(),
        ]);
    }

    /**
     * Method yang menampilkan halaman DELETE USER /users/delete?
     * 
     * @param string  @nik
     * @param string  @nama
     * @param string  @fungsi
     * @param string  @site
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete()
    {
        $str_encoder = new Common();

        $nik = $str_encoder->base64urlDecode($this->request->getGet('nik'));
        $nama = $str_encoder->base64urlDecode($this->request->getGet('nama'));
        $fungsi = $str_encoder->base64urlDecode($this->request->getGet('fungsi'));
        $site = $str_encoder->base64urlDecode($this->request->getGet('site'));

        if($this->model->destroy($nik, $nama, $fungsi, $site)) {

            cache()->delete('dataUsers');

            return redirect()->to('users')
                        ->with('success', 'Data user berhasil di hapus.');
        } else {
            return redirect()->back()
                        ->with('error', 'Data user gagal di hapus.');
        }
    }

	/**
     * API yang digunakan untuk me-retrieve data dari database
     * untuk halaman /users
     * 
     * @param bool  @refresh
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function apiGetAll()
	{
        if($this->request->getMethod() != 'post') {
            return redirect()->to('/');
        }

        if($this->request->getPost('reload') != null && $this->request->getPost('reload')) {
            cache()->delete('dataUsers');
        }

		if( ! $dataUsers = cache('dataUsers')) {

            $dataUsers = $this->model->findAll();

            cache()->save('dataUsers', $dataUsers, 1200);
        }

        $str_encoder = new Common();

        $arrData = [];
        foreach ($dataUsers as $key => $val) {
            $nik_enc = $str_encoder->base64urlEncode($val['NIK']);
            $nama_enc = $str_encoder->base64urlEncode($val['Nama']);
            $fungsi_enc = ($val['Fungsi'] != null) ? $str_encoder->base64urlEncode($val['Fungsi']) : $str_encoder->base64urlEncode('null');
            $site_enc = ($val['Site'] != null) ? $str_encoder->base64urlEncode($val['Site']) : $str_encoder->base64urlEncode('null');
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

    /**
     * Method yang digunakan untuk memproses penambahan user
     * atau create user function
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
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

        if( ! $this->model->validate($data) ) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', '<p>' . implode('</p><p>', $this->model->errors()) . '</p>');
        }

        if($this->model->getByParams($nik, $nama, $fungsi, $site)->getNumRows() > 0) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Data dengan NIK=' . $nik . ', Nama='. $nama . ', Fungsi='. $fungsi . ', Site='. $site . ' sudah exist di database.');
        }

        if( $this->model->insert($data, false) ) {

            cache()->delete('dataUsers');

            return redirect()->to('users')
                            ->with('success', 'Data user berhasil ditambahkan.');
        }

        return redirect()->back()
                        ->withInput()
                        ->with('error', 'Terjadi kesalahan.');
    }

    /**
     * Method yang digunakan untuk memproses update user
     * atau edit user function
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
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

        if( ! $this->model->validate($data) ) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', '<p>' . implode('</p><p>', $this->model->errors()) . '</p>');
        }

        if( $this->model->getByParams($nik, $nama, $fungsi, $site)->getNumRows() > 0 &&
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

        if( $this->model->updateByParams($params, $data) ) {

            cache()->delete('dataUsers');
            
            return redirect()->to('users')
                            ->with('success', 'Data user berhasil diupdate.');
        }

        return redirect()->back()
                        ->withInput()
                        ->with('error', 'Terjadi kesalahan.');
    }

    private function getUsersFungsi()
    {
        $data = [];
        if($this->model->getFungsi()->getNumRows() > 0) {
            foreach($this->model->getFungsi()->getResult() as $row) {
                $data[] = $row->Fungsi;
            }
        }
        $sites = [];
        if($this->model->getSites()->getNumRows() > 0) {
            foreach($this->model->getSites()->getResult() as $row) {
                if($row->Site == '--') {
                    continue;
                }
                $sites[] = $row->Site;
            }
        }

        return [
            'fungsi' => $data,
            'sites' => $sites
        ];
    }
}