<?php

namespace App\Controllers;

class Users extends BaseController
{
	public function index()
	{
		return view('Users/main', [
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

        $limit = $this->request->getGet('length');
        $offset = $this->request->getGet('start');

        if($this->request->getGet('order')) {
            $sort = $this->request->getGet('order')['0']['dir'];
            switch ($this->request->getGet('order')['0']['column']) {
                case 1:
                    $column = 'NIK';
                    break;
                 case 2:
                    $column = 'Nama';
                    break;
                case 3:
                    $column = 'Fungsi';
                    break;
                case 4:
                    $column = 'Site';
                    break;
                case 5:
                    $column = 'Kode SPMB';
                    break;
                case 6:
                    $column = 'CompId';
                    break;
                case 7:
                    $column = 'DeptId';
                    break;
                default:
                    $column = 'NIK';
            }
            usort($dataUsers, function($a, $b) use ($sort, $column) {
                if($sort == 'desc') {
                    return $b[$column] <=> $a[$column];
                } else {
                    return $a[$column] <=> $b[$column];
                }
            });
        }

        $data = array_slice($dataUsers, $offset, $limit);

        $response = [
            'draw' => ($this->request->getGet('draw') != null) ? $this->request->getGet('draw') : 0,
            'recordsTotal' => count($data),
            'recordsFiltered' => count($dataUsers),
            'data' => $data,
        ];

        return $this->response->setJSON($response);
	}	
}