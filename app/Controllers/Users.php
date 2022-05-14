<?php

namespace App\Controllers;

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

	public function apiGetAll()
	{
		if( ! $dataUsers = cache('dataUsers')) {
            $data = "select * from SPMB_ACC_USER";
            $query = $this->db->simpleQuery($data);
            do {
                $results = [];
                while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                    $results[] = $row;
                }
            } while (sqlsrv_next_result($query));

            $dataUsers = $results;

            cache()->save('dataUsers', $dataUsers, 1200);
        }

        $arrData = [];
        foreach ($dataUsers as $key => $val) {
            $arrData[] = [
                $key + 1,
                $val['NIK'],
                $val['Nama'],
                $val['Fungsi'],
                $val['Site'],
                '<div class="kodespmb-wrapper">' . $val['KodeSPMB'] . '</div>',
                '<div class="dept-id-wrapper">' . $val['DeptId'] . '</div>',
                '<div class="comp-id-wrapper">' . $val['CompId'] . '</div>',
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

        $data = [
            'NIK' => $this->request->getPost('nik'),
            'Nama' => $this->request->getPost('nama'),
            'Fungsi' => $this->request->getPost('fungsi'),
            'Site' => $this->request->getPost('site'),
            'KodeSPMB' => $this->request->getPost('kode_spmb'),
            'DeptId' => $this->request->getPost('deptid'),
            'compid' => $this->request->getPost('compid')
        ];

        $spmb_acc_user_tbl = $this->db->table('SPMB_ACC_USER');
        if($spmb_acc_user_tbl->insert($data)) {
            $response = [
                'success' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => 'Silahkan periksa kembali'
            ];
        }
    }

    public function getUsersFungsi()
    {
        $spmb_acc_user_tbl = $this->db->table('SPMB_ACC_USER');
        $query = $spmb_acc_user_tbl->select('Fungsi')
                                    ->where('Fungsi !=', NULL)
                                    ->orderBy('Fungsi', 'asc')
                                    ->distinct()
                                    ->get();
        $query_site = $spmb_acc_user_tbl->select('Site')
                                    ->where('Site !=', NULL)
                                    ->orderBy('Site', 'asc')
                                    ->distinct()
                                    ->get();
        $data = [];
        if($query->getNumRows() > 0) {
            foreach($query->getResult() as $row) {
                $data[] = $row->Fungsi;
            }
        }
        $sites = [];
        if($query_site->getNumRows() > 0) {
            foreach($query_site->getResult() as $row) {
                $sites[] = $row->Site;
            }
        }

        $response = [
            'success' => true,
            'fungsi' => $data,
            'sites' => $sites
        ];

        return $this->response->setJSON($response);
    }
}