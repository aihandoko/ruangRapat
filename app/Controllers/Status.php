<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Status extends BaseController
{
    protected $db;
    protected $db2;
    protected $db3;

    public function __construct()
    {
        $this->db = \Config\Database::connect($group = null);
        $this->db2 = \Config\Database::connect($group = null);
        $this->db3 = \Config\Database::connect($group = 'nls');
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

    public function detail($id)
    {
        $route_query = "select Route, DeptId from SPMB_ACC where SPMBNo='".$id."'";
        $exc_route_query = $this->db->simpleQuery($route_query);
        do {
            $route_res = [];
            while($route_row = sqlsrv_fetch_array($exc_route_query, SQLSRV_FETCH_ASSOC)) {
                $route_res[] = $route_row;
            }
        } while (sqlsrv_next_result($exc_route_query));

        $dept_query = "select DeptName from SPMB_DEPT where DeptId='".$route_res[0]['DeptId']."'";
        $exc_dept_query = $this->db->simpleQuery($dept_query);
        do {
            while($dept_row = sqlsrv_fetch_array($exc_dept_query, SQLSRV_FETCH_ASSOC)) {
                $dept_res = $dept_row;
            }
        } while (sqlsrv_next_result($exc_dept_query));

        $data = "select distinct a.ReqNo, a.ReqDate, a.CompId, a.DeptId, a.ReqDescription, a.AttachmentPath, b.AuthRoute, b.ReqSeqNo, b.ItemId, b.ItemQty, b.TargetDate, b.ReqNote, c.ItemName, d.UnitCode, b.AccountNo from Request_H a, Request_D b, Item c, Units d where a.ReqType='PR' and a.ReqType=b.ReqType and a.CompId=b.CompId  and a.ReqNo=b.ReqNo and b.ItemId=c.ItemId and c.CompId=rtrim(a.CompId) and c.UnitId=d.UnitId and rtrim(a.CompId)+'-'+CONVERT(VARCHAR,a.ReqNo) = '".$id."'";
        $query = $this->db3->simpleQuery($data);
        do {
            $results = [];
            while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
        } while (sqlsrv_next_result($query));

        $route_auth = "select * from SPMB_ACC_ROUTE where Kode='".$results[0]['AuthRoute']."'";
        $exc_route_auth = $this->db->simpleQuery($route_auth);
        do {
            $auth_res = [];
            while($auth_row = sqlsrv_fetch_array($exc_route_auth, SQLSRV_FETCH_ASSOC)) {
                $auth_res[] = $auth_row;
            }
        } while (sqlsrv_next_result($exc_route_auth));

        $otorisasi_query = "select a.Acc, b.Nama, a.TglAcc, a.Posisi, isnull(a.Tolak,0) Tolak, isnull(a.Batal,0) Batal from SPMB_ACC a, SPMB_ACC_USER b where a.Acc is not null and a.SPMBNo='".$id."' and b.NIK=a.Acc";
        $exc_otorisasi_query = $this->db->simpleQuery($otorisasi_query);
        do {
            $otorisasi_res = [];
            while($otorisasi_row = sqlsrv_fetch_array($exc_otorisasi_query, SQLSRV_FETCH_ASSOC)) {
                $otorisasi_res[] = $otorisasi_row;
            }
        } while (sqlsrv_next_result($exc_otorisasi_query));

        return view('Status/detail', [
            'data' => $results,
            'routes' => $route_res,
            'DeptName' => $dept_res['DeptName'],
            'otorisasi' => $otorisasi_res,
            'route_otorisasi' => implode(' > ', $auth_res[0])
        ]);
    }
}