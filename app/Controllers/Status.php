<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Status extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect($group = null, true);
    }

    public function index()
    {
        try {
            $data = "spReadSPMBStatus2014";
            $query = $this->db->simpleQuery($data);
            do {
                $results = [];
                while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                    // echo print_r($row, true);
                    $results[] = $row;
                }
            } while (sqlsrv_next_result($query));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return view('Status/main',[
            'data' => $results
        ]);
    }

    public function withParams()
    {
        if($this->request->getMethod() != 'post') {
            return redirect()->to('/');
        }

        $unit = $this->request->getPost('unit');
        $unit2 = $this->request->getPost('unit2');
        $no = $this->request->getPost('no');
        $no2 = $this->request->getPost('no2');
        $tahun = $this->request->getPost('tahun');
        $tahun2 = $this->request->getPost('tahun2');
        $deptId = $this->request->getPost('deptId');

        try {
            $data = "spReadSPMBStatus2014_Parm '".$unit."','".$unit2."','".$no."','".$no2."','".$tahun."','".$tahun2."','".$deptId."'";
            $query = $this->db->simpleQuery($data);
            do {
                $results = [];
                while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                    $results[] = $row;
                }
            } while (sqlsrv_next_result($query));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return view('Status/params',[
            'data' => $results,
            'dataPost' => [
                'unit' => $unit,
                'unit2' => $unit2,
                'no' => $no,
                'no2' => $no2,
                'tahun' => $tahun,
                'tahun2' => $tahun2,
                'deptId' => $deptId
            ]
        ]);
    }

    public function tes()
    {
        $model = new \App\Models\StatusModel;
        $var1 = '020';
        $var2 = '020';
        $var3 = '123';
        $var4 = '999';
        $var5 = '';
        $var6 = '';
        $var7 = '';
        
        $model->execute_sp($var1, $var2, $var3, $var4, $var5, $var6, $var7);
    }
}