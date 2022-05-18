<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Status extends BaseController
{
    public function tes()
    {
        return view('Status/dummy', [
            'functions' => $this->getFungsi(),
            'auth' => $this->auth
        ]);
    }

    public function index()
    {
        return view('Status/main', [
            'page_title' => 'Status',
            'functions' => $this->getFungsi(),
            'auth' => $this->auth
        ]);
    }

    public function apiGetAll()
    {
        if( ! $dataStatus = cache('dataStatus')) {
            $data = "spReadSPMBStatus2014";
            $query = $this->db->simpleQuery($data);
            do {
                $results = [];
                while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                    // echo print_r($row, true);
                    $row['DateConverted'] = [
                        ($row['ACC1'] != null) ? $this->dateConverter($row['ACC1']) : null,
                        ($row['ACC2'] != null) ? $this->dateConverter($row['ACC2']) : null,
                        ($row['ACC3'] != null) ? $this->dateConverter($row['ACC3']) : null,
                        ($row['ACC4'] != null) ? $this->dateConverter($row['ACC4']) : null,
                        ($row['ACC5'] != null) ? $this->dateConverter($row['ACC5']) : null,
                        ($row['ACC6'] != null) ? $this->dateConverter($row['ACC6']) : null,
                        ($row['ACC7'] != null) ? $this->dateConverter($row['ACC7']) : null,
                        ($row['ACC8'] != null) ? $this->dateConverter($row['ACC8']) : null,
                        ($row['ACC9'] != null) ? $this->dateConverter($row['ACC9']) : null,
                        ($row['ACC10'] != null) ? $this->dateConverter($row['ACC10']) : null
                    ];
                    $results[] = $row;
                }
            } while (sqlsrv_next_result($query));

            $dataStatus = $results;

            cache()->save('dataStatus', $dataStatus, 1200);
        }

        $arrData = [];
        foreach ($dataStatus as $key => $val) {
            $step1 = ($val['Step1'] != null) ? $val['Step1'] : '';
            $acc1 = ($val['DateConverted'][0] != null) ? '<div>' . $val['DateConverted'][0] . '</div>' : '';
            $step2 = ($val['Step2'] != null) ? $val['Step2'] : '';
            $acc2 = ($val['DateConverted'][1] != null) ? '<div>' . $val['DateConverted'][1] . '</div>' : '';
            $step3 = ($val['Step3'] != null) ? $val['Step3'] : '';
            $acc3 = ($val['DateConverted'][2] != null) ? '<div>' . $val['DateConverted'][2] . '</div>' : '';
            $step4 = ($val['Step4'] != null) ? $val['Step4'] : '';
            $acc4 = ($val['DateConverted'][3] != null) ? '<div>' . $val['DateConverted'][3] . '</div>' : '';
            $step5 = ($val['Step5'] != null) ? $val['Step5'] : '';
            $acc5 = ($val['DateConverted'][4] != null) ? '<div>' . $val['DateConverted'][4] . '</div>' : '';
            $step6 = ($val['Step6'] != null) ? $val['Step6'] : '';
            $acc6 = ($val['DateConverted'][5] != null) ? '<div>' . $val['DateConverted'][5] . '</div>' : '';
            $step7 = ($val['Step7'] != null) ? $val['Step7'] : '';
            $acc7 = ($val['DateConverted'][6] != null) ? '<div>' . $val['DateConverted'][6] . '</div>' : '';
            if(session()->get('Fungsi') == 'Admin') {
                $tbl = $this->db->table('SPMB_ACC');
                $query = $tbl->select('Posisi')->where('SPMBNo', $val['SPMBNo'])->get();
                if($query->getNumRows() > 0) {
                    $options = [];
                    foreach($query->getResult() as $r) {
                        $options[] = '<option value="'.$r->Posisi.'">'.$r->Posisi.'</option>';
                    }
                    $select = '<select class="custom-form">' . implode('', $options) . '</select>';
                } else {
                    $select = '';
                }
                $arrData[] = [
                    $key + 1,
                    '<a href="' . site_url('status/detail/'.$val['SPMBNo']) . '">' . $val['SPMBNo'] . '</a>',
                    $val['Site'],
                    $step1 . $acc1,
                    $step2 . $acc2,
                    $step3 . $acc3,
                    $step4 . $acc4,
                    $step5 . $acc5,
                    $step6 . $acc6,
                    $step7 . $acc7,
                    $select
                ];
            } else {
                $arrData[] = [
                    $key + 1,
                    '<a href="' . site_url('status/detail/'.$val['SPMBNo']) . '">' . $val['SPMBNo'] . '</a>',
                    $val['Site'],
                    $step1 . $acc1,
                    $step2 . $acc2,
                    $step3 . $acc3,
                    $step4 . $acc4,
                    $step5 . $acc5,
                    $step6 . $acc6,
                    $step7 . $acc7,
                ];
            }
        }

        $response = $arrData;

        return $this->response->setJSON($response);
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
        $tahun = '';
        $tahun2 = '';
        $deptId = $this->request->getPost('deptId');

        try {
            $data = "spReadSPMBStatus2014_Parm '".$unit."','".$unit2."','".$no."','".$no2."','".$tahun."','".$tahun2."','".$deptId."'";
            $query = $this->db->simpleQuery($data);
            do {
                $results = [];
                while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                    $row['DateConverted'] = [
                        ($row['ACC1'] != null) ? $this->dateConverter($row['ACC1']) : null,
                        ($row['ACC2'] != null) ? $this->dateConverter($row['ACC2']) : null,
                        ($row['ACC3'] != null) ? $this->dateConverter($row['ACC3']) : null,
                        ($row['ACC4'] != null) ? $this->dateConverter($row['ACC4']) : null,
                        ($row['ACC5'] != null) ? $this->dateConverter($row['ACC5']) : null,
                        ($row['ACC6'] != null) ? $this->dateConverter($row['ACC6']) : null,
                        ($row['ACC7'] != null) ? $this->dateConverter($row['ACC7']) : null,
                        ($row['ACC8'] != null) ? $this->dateConverter($row['ACC8']) : null,
                        ($row['ACC9'] != null) ? $this->dateConverter($row['ACC9']) : null,
                        ($row['ACC10'] != null) ? $this->dateConverter($row['ACC10']) : null
                    ];
                    $results[] = $row;
                }
            } while (sqlsrv_next_result($query));
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $arrData = [];
        foreach ($results as $key => $val) {
            $step1 = ($val['Step1'] != null) ? $val['Step1'] : '';
            $acc1 = ($val['DateConverted'][0] != null) ? '<div>' . $val['DateConverted'][0] . '</div>' : '';
            $step2 = ($val['Step2'] != null) ? $val['Step2'] : '';
            $acc2 = ($val['DateConverted'][1] != null) ? '<div>' . $val['DateConverted'][1] . '</div>' : '';
            $step3 = ($val['Step3'] != null) ? $val['Step3'] : '';
            $acc3 = ($val['DateConverted'][2] != null) ? '<div>' . $val['DateConverted'][2] . '</div>' : '';
            $step4 = ($val['Step4'] != null) ? $val['Step4'] : '';
            $acc4 = ($val['DateConverted'][3] != null) ? '<div>' . $val['DateConverted'][3] . '</div>' : '';
            $step5 = ($val['Step5'] != null) ? $val['Step5'] : '';
            $acc5 = ($val['DateConverted'][4] != null) ? '<div>' . $val['DateConverted'][4] . '</div>' : '';
            $step6 = ($val['Step6'] != null) ? $val['Step6'] : '';
            $acc6 = ($val['DateConverted'][5] != null) ? '<div>' . $val['DateConverted'][5] . '</div>' : '';
            $step7 = ($val['Step7'] != null) ? $val['Step7'] : '';
            $acc7 = ($val['DateConverted'][6] != null) ? '<div>' . $val['DateConverted'][6] . '</div>' : '';
            $arrData[] = [
                $key + 1,
                '<a href="' . site_url('status/detail/'.$val['SPMBNo']) . '">' . $val['SPMBNo'] . '</a>',
                $val['Site'],
                $step1 . $acc1,
                $step2 . $acc2,
                $step3 . $acc3,
                $step4 . $acc4,
                $step5 . $acc5,
                $step6 . $acc6,
                $step7 . $acc7,
            ];
        }

        $response = $arrData;

        return $this->response->setJSON($response);
    }

    public function detail($id)
    {

        $this->breadcrumbs->add('<i class="fas fa-home"></i>', '/');
        $this->breadcrumbs->add('Antrian', '/queue');
        $this->breadcrumbs->add('Antrian ACC', '/queue');

        $route_query = "select Site, Route, DeptId from SPMB_ACC where SPMBNo='".$id."'";
        $exc_route_query = $this->db->simpleQuery($route_query);
        do {
            $route_res = [];
            while($route_row = sqlsrv_fetch_array($exc_route_query, SQLSRV_FETCH_ASSOC)) {
                $route_res[] = $route_row;
            }
        } while (sqlsrv_next_result($exc_route_query));

        $dept_query = "select DeptName from SPMB_DEPT where DeptId='".$route_res[0]['DeptId']."'";
        $exc_dept_query = $this->db->simpleQuery($dept_query);
        if(sqlsrv_num_rows($exc_dept_query) > 0) {
            do {
                while($dept_row = sqlsrv_fetch_array($exc_dept_query, SQLSRV_FETCH_ASSOC)) {
                    $dept_res = $dept_row;
                }
            } while (sqlsrv_next_result($exc_dept_query));
            $DeptName = $dept_res['DeptName'];
        } else {
            $DeptName = '';
        }

        $data = "select distinct a.ReqNo, a.ReqDate, a.CompId, a.DeptId, a.ReqDescription, a.AttachmentPath, b.AuthRoute, b.ReqSeqNo, b.ItemId, b.ItemQty, b.TargetDate, b.ReqNote, c.ItemName, d.UnitCode, b.AccountNo from Request_H a, Request_D b, Item c, Units d where a.ReqType='PR' and a.ReqType=b.ReqType and a.CompId=b.CompId  and a.ReqNo=b.ReqNo and b.ItemId=c.ItemId and c.CompId=rtrim(a.CompId) and c.UnitId=d.UnitId and rtrim(a.CompId)+'-'+CONVERT(VARCHAR,a.ReqNo) = '".$id."'";
        $query = $this->db3->simpleQuery($data);
        do {
            $results = [];
            while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
        } while (sqlsrv_next_result($query));

        if(count($results) > 0) {
            $route_auth = "select * from SPMB_ACC_ROUTE where Kode='".$results[0]['AuthRoute']."'";
            $exc_route_auth = $this->db->simpleQuery($route_auth);
            do {
                $auth_res = [];
                while($auth_row = sqlsrv_fetch_array($exc_route_auth, SQLSRV_FETCH_ASSOC)) {
                    $auth_res[] = $auth_row;
                }
            } while (sqlsrv_next_result($exc_route_auth));

            $route_otorisasi = [];
            foreach ($auth_res[0] as $key => $value) {
                if($key !== 'Kode' && $value !== null) {
                    $route_otorisasi[] = $value;
                }
            }
        } else {
            $route_otorisasi = [];
        }

        $auth_query_spmb_acc = "select Acc, TglAcc, Posisi, isnull(Tolak,0) Tolak, isnull(Batal,0) Batal from SPMB_ACC where SPMBNo='".$id."'";
        $exc_auth_query = $this->db->simpleQuery($auth_query_spmb_acc);
        do {
            $auth_res = [];
            while($auth_row = sqlsrv_fetch_array($exc_auth_query, SQLSRV_FETCH_ASSOC)) {
                $auth_res[] = $auth_row;
            }
        } while (sqlsrv_next_result($exc_auth_query));

        $auth_tbl = $this->db->table('SPMB_ACC_USER');
        $auth_query = $auth_tbl->select('Nama')->where('NIK', $auth_res[0]['Acc'])->get();
        if($auth_query->getNumRows() > 0) {
            foreach ($auth_query->getResult() as $value) {
                $nama = $value->Nama;
            }
            $otorisasi_res = $nama;
        } else {
            $otorisasi_res = '';
        }

        $notes_query = "select Posisi, Catatan from SPMB_ACC where SPMBNo = '".$id."' order by NoUrut Desc";
        $exc_notes_query = $this->db->simpleQuery($notes_query);
        do {
            $notes_res = [];
            while($notes_row = sqlsrv_fetch_array($exc_notes_query, SQLSRV_FETCH_ASSOC)) {
                $notes_res[] = $notes_row;
            }
        } while (sqlsrv_next_result($exc_notes_query));
        // dd($this->auth);

        if(count($results) > 0) {
            return view('Status/detail', [
                'page_title' => 'ACC SPMB',
                'functions' => $this->getFungsi(),
                'auth' => $this->auth,
                'data' => $results,
                'routes' => $route_res,
                'DeptName' => $DeptName,
                'otorisasi' => $otorisasi_res,
                'auth_res' => $auth_res,
                'route_otorisasi' => implode(' > ', $route_otorisasi),
                'notes' => $notes_res,
                'breadcrumbs' => $this->breadcrumbs->render(),
            ]);
        } else {
            return view('Status/detail_not_found', [
                'page_title' => 'ACC SPMB',
                'functions' => $this->getFungsi(),
                'auth' => $this->auth,
                'breadcrumbs' => $this->breadcrumbs->render(),
            ]);
        }
    }

    public function deny($id)
    {
        // $queue = (new \App\Controllers\Queue())->getQueue();
        // $queue_val = array_map(function($val) {
        //     return trim($val['SPMBNo']);
        // }, $queue);
        // if(count($queue) == 0 || ! in_array($id, $queue_val)) {
        //     return redirect()->to('/');
        // }

        $this->breadcrumbs->add('<i class="fas fa-home"></i>', '/');
        $this->breadcrumbs->add('Antrian', '/queue');
        $this->breadcrumbs->add('Antrian ACC', '/queue');

        $route_query = "select Site, Route, DeptId from SPMB_ACC where SPMBNo='".$id."'";
        $exc_route_query = $this->db->simpleQuery($route_query);
        do {
            $route_res = [];
            while($route_row = sqlsrv_fetch_array($exc_route_query, SQLSRV_FETCH_ASSOC)) {
                $route_res[] = $route_row;
            }
        } while (sqlsrv_next_result($exc_route_query));

        $dept_query = "select DeptName from SPMB_DEPT where DeptId='".$route_res[0]['DeptId']."'";
        $exc_dept_query = $this->db->simpleQuery($dept_query);
        if(sqlsrv_num_rows($exc_dept_query) > 0) {
            do {
                while($dept_row = sqlsrv_fetch_array($exc_dept_query, SQLSRV_FETCH_ASSOC)) {
                    $dept_res = $dept_row;
                }
            } while (sqlsrv_next_result($exc_dept_query));
            $DeptName = $dept_res['DeptName'];
        } else {
            $DeptName = '';
        }

        $data = "select distinct a.ReqNo, a.ReqDate, a.CompId, a.DeptId, a.ReqDescription, a.AttachmentPath, b.AuthRoute, b.ReqSeqNo, b.ItemId, b.ItemQty, b.TargetDate, b.ReqNote, c.ItemName, d.UnitCode, b.AccountNo from Request_H a, Request_D b, Item c, Units d where a.ReqType='PR' and a.ReqType=b.ReqType and a.CompId=b.CompId  and a.ReqNo=b.ReqNo and b.ItemId=c.ItemId and c.CompId=rtrim(a.CompId) and c.UnitId=d.UnitId and rtrim(a.CompId)+'-'+CONVERT(VARCHAR,a.ReqNo) = '".$id."'";
        $query = $this->db3->simpleQuery($data);
        do {
            $results = [];
            while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
        } while (sqlsrv_next_result($query));

        if(count($results) > 0) {
            $route_auth = "select * from SPMB_ACC_ROUTE where Kode='".$results[0]['AuthRoute']."'";
            $exc_route_auth = $this->db->simpleQuery($route_auth);
            do {
                $auth_res = [];
                while($auth_row = sqlsrv_fetch_array($exc_route_auth, SQLSRV_FETCH_ASSOC)) {
                    $auth_res[] = $auth_row;
                }
            } while (sqlsrv_next_result($exc_route_auth));

            $route_otorisasi = [];
            foreach ($auth_res[0] as $key => $value) {
                if($key !== 'Kode' && $value !== null) {
                    $route_otorisasi[] = $value;
                }
            }
        } else {
            $route_otorisasi = [];
        }

        // $otorisasi_query = "select a.Acc, b.Nama, a.TglAcc, a.Posisi, isnull(a.Tolak,0) Tolak, isnull(a.Batal,0) Batal from SPMB_ACC a, SPMB_ACC_USER b where a.Acc is not null and a.SPMBNo='".$id."' and b.NIK=a.Acc";
        $auth_query_spmb_acc = "select Acc, TglAcc, Posisi, isnull(Tolak,0) Tolak, isnull(Batal,0) Batal from SPMB_ACC where SPMBNo='".$id."'";
        $exc_auth_query = $this->db->simpleQuery($auth_query_spmb_acc);
        do {
            $auth_res = [];
            while($auth_row = sqlsrv_fetch_array($exc_auth_query, SQLSRV_FETCH_ASSOC)) {
                $auth_res[] = $auth_row;
            }
        } while (sqlsrv_next_result($exc_auth_query));

        // Ambil yang atas aja

        $auth_tbl = $this->db->table('SPMB_ACC_USER');
        $auth_query = $auth_tbl->select('Nama')->where('NIK', $auth_res[0]['Acc'])->get();
        if($auth_query->getNumRows() > 0) {
            foreach ($auth_query->getResult() as $value) {
                $nama = $value->Nama;
            }
            $otorisasi_res = $nama;
        } else {
            $otorisasi_res = '';
        }
        // $otorisasi_query = "select Nama from SPMB_ACC_USER where NIK='".$auth_res[0]['Acc']."'";
        // $exc_otorisasi_query = $this->db->simpleQuery($otorisasi_query);
        // do {
        //     $otorisasi_res = [];
        //     while($otorisasi_row = sqlsrv_fetch_array($exc_otorisasi_query, SQLSRV_FETCH_ASSOC)) {
        //         $otorisasi_res[] = $otorisasi_row;
        //     }
        // } while (sqlsrv_next_result($exc_otorisasi_query));
        // dd($otorisasi_res);

        $notes_query = "select Posisi, Catatan from SPMB_ACC where SPMBNo = '".$id."' order by NoUrut Desc";
        $exc_notes_query = $this->db->simpleQuery($notes_query);
        do {
            $notes_res = [];
            while($notes_row = sqlsrv_fetch_array($exc_notes_query, SQLSRV_FETCH_ASSOC)) {
                $notes_res[] = $notes_row;
            }
        } while (sqlsrv_next_result($exc_notes_query));

        return view('Status/deny', [
            'page_title' => 'ACC SPMB',
            'breadcrumbs' => $this->breadcrumbs->render(),
            'functions' => $this->getFungsi(),
            'auth' => $this->auth,
            'data' => $results,
            'routes' => $route_res,
            'DeptName' => $DeptName,
            'otorisasi' => $otorisasi_res,
            'auth_res' => $auth_res,
            'route_otorisasi' => implode(' > ', $route_otorisasi),
            'route_kode' => $results[0]['AuthRoute'],
            'notes' => $notes_res,
            'id' => $id
        ]);
    }

    public function acc($id)
    {
        $queue = (new \App\Controllers\Queue())->getQueue();
        $queue_val = array_map(function($val) {
            return trim($val['SPMBNo']);
        }, $queue);
        if(count($queue) == 0 || ! in_array($id, $queue_val)) {
            return redirect()->to('/');
        }

        $this->breadcrumbs->add('<i class="fas fa-home"></i>', '/');
        $this->breadcrumbs->add('Antrian', '/queue');
        $this->breadcrumbs->add('Antrian ACC', '/queue');

        $route_query = "select Site, Route, DeptId from SPMB_ACC where SPMBNo='".$id."'";
        $exc_route_query = $this->db->simpleQuery($route_query);
        do {
            $route_res = [];
            while($route_row = sqlsrv_fetch_array($exc_route_query, SQLSRV_FETCH_ASSOC)) {
                $route_res[] = $route_row;
            }
        } while (sqlsrv_next_result($exc_route_query));

        $dept_query = "select DeptName from SPMB_DEPT where DeptId='".$route_res[0]['DeptId']."'";
        $exc_dept_query = $this->db->simpleQuery($dept_query);
        if(sqlsrv_num_rows($exc_dept_query) > 0) {
            do {
                while($dept_row = sqlsrv_fetch_array($exc_dept_query, SQLSRV_FETCH_ASSOC)) {
                    $dept_res = $dept_row;
                }
            } while (sqlsrv_next_result($exc_dept_query));
            $DeptName = $dept_res['DeptName'];
        } else {
            $DeptName = '';
        }

        // $nls_table = $this->db3->table('Request_H');
        // $query = $nls_table->select('a.ReqNo, a.ReqDate, a.CompId, a.DeptId, a.ReqDescription, a.AttachmentPath, b.AuthRoute, b.ReqSeqNo, b.ItemId, b.ItemQty, b.TargetDate, b.ReqNote, c.ItemName, d.UnitCode, b.AccountNo')->from('Request_H a')

        $data = "select distinct a.ReqNo, a.ReqDate, a.CompId, a.DeptId, a.ReqDescription, a.AttachmentPath, b.AuthRoute, b.ReqSeqNo, b.ItemId, b.ItemQty, b.TargetDate, b.ReqNote, c.ItemName, d.UnitCode, b.AccountNo from Request_H a, Request_D b, Item c, Units d where a.ReqType='PR' and a.ReqType=b.ReqType and a.CompId=b.CompId  and a.ReqNo=b.ReqNo and b.ItemId=c.ItemId and c.CompId=rtrim(a.CompId) and c.UnitId=d.UnitId and rtrim(a.CompId)+'-'+CONVERT(VARCHAR,a.ReqNo) = '".$id."'";
        $query = $this->db3->simpleQuery($data);
        do {
            $results = [];
            while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
        } while (sqlsrv_next_result($query));

        if(count($results) > 0) {
            $route_auth = "select * from SPMB_ACC_ROUTE where Kode='".$results[0]['AuthRoute']."'";
            $exc_route_auth = $this->db->simpleQuery($route_auth);
            do {
                $auth_res = [];
                while($auth_row = sqlsrv_fetch_array($exc_route_auth, SQLSRV_FETCH_ASSOC)) {
                    $auth_res[] = $auth_row;
                }
            } while (sqlsrv_next_result($exc_route_auth));

            $route_otorisasi = [];
            foreach ($auth_res[0] as $key => $value) {
                if($key !== 'Kode' && $value !== null) {
                    $route_otorisasi[] = $value;
                }
            }
        } else {
            $route_otorisasi = [];
        }

        // $otorisasi_query = "select a.Acc, b.Nama, a.TglAcc, a.Posisi, isnull(a.Tolak,0) Tolak, isnull(a.Batal,0) Batal from SPMB_ACC a, SPMB_ACC_USER b where a.Acc is not null and a.SPMBNo='".$id."' and b.NIK=a.Acc";
        $auth_query_spmb_acc = "select Acc, TglAcc, Posisi, isnull(Tolak,0) Tolak, isnull(Batal,0) Batal from SPMB_ACC where SPMBNo='".$id."'";
        $exc_auth_query = $this->db->simpleQuery($auth_query_spmb_acc);
        do {
            $auth_res = [];
            while($auth_row = sqlsrv_fetch_array($exc_auth_query, SQLSRV_FETCH_ASSOC)) {
                $auth_res[] = $auth_row;
            }
        } while (sqlsrv_next_result($exc_auth_query));

        // Ambil yang atas aja

        $auth_tbl = $this->db->table('SPMB_ACC_USER');
        $auth_query = $auth_tbl->select('Nama')->where('NIK', $auth_res[0]['Acc'])->get();
        if($auth_query->getNumRows() > 0) {
            foreach ($auth_query->getResult() as $value) {
                $nama = $value->Nama;
            }
            $otorisasi_res = $nama;
        } else {
            $otorisasi_res = '';
        }
        // $otorisasi_query = "select Nama from SPMB_ACC_USER where NIK='".$auth_res[0]['Acc']."'";
        // $exc_otorisasi_query = $this->db->simpleQuery($otorisasi_query);
        // do {
        //     $otorisasi_res = [];
        //     while($otorisasi_row = sqlsrv_fetch_array($exc_otorisasi_query, SQLSRV_FETCH_ASSOC)) {
        //         $otorisasi_res[] = $otorisasi_row;
        //     }
        // } while (sqlsrv_next_result($exc_otorisasi_query));
        // dd($otorisasi_res);

        $notes_query = "select Posisi, Catatan from SPMB_ACC where SPMBNo = '".$id."' order by NoUrut Desc";
        $exc_notes_query = $this->db->simpleQuery($notes_query);
        do {
            $notes_res = [];
            while($notes_row = sqlsrv_fetch_array($exc_notes_query, SQLSRV_FETCH_ASSOC)) {
                $notes_res[] = $notes_row;
            }
        } while (sqlsrv_next_result($exc_notes_query));

        dd($results);

        return view('Status/acc', [
            'page_title' => 'ACC SPMB',
            'breadcrumbs' => $this->breadcrumbs->render(),
            'functions' => $this->getFungsi(),
            'auth' => $this->auth,
            'data' => $results,
            'routes' => $route_res,
            'DeptName' => $DeptName,
            'otorisasi' => $otorisasi_res,
            'auth_res' => $auth_res,
            'route_otorisasi' => implode(' > ', $route_otorisasi),
            'route_kode' => $results[0]['AuthRoute'],
            'notes' => $notes_res,
            'id' => $id
        ]);
    }

    // ACC ANTRIAN PROSES
    public function accProcess()
    {
        $acc_notes = $this->request->getPost('acc_notes');
        $approval = $this->request->getPost('approval');
        $reqno = (int)$this->request->getPost('reqno');
        $compid = (int)$this->request->getPost('compid');
        $spmbno = (int)$this->request->getPost('spmbno');
        $kode_route = (int)$this->request->getPost('kode_route');

        if($approval == 'acc') {
            $Tolak = 0;
            $Batal = 0;
        } elseif($approval == 'tolak') {
            $Tolak = 1;
            $Batal = 0;
        } else {
            $Tolak = 0;
            $Batal = 1;
        }

        $now = (Time::now())->toDateTimeString();
        $spmb_acc_tbl = $this->db->table('SPMB_ACC');
        $data = [
            'TglAcc' => $now,
            'Acc' => session()->get('NIK'),
            'Catatan' => $acc_notes,
            'Tolak' => $Tolak,
            'Batal' => $Batal,
        ];
        $upd_spmb_acc = $spmb_acc_tbl->where('SPMBNo', $spmbno)
                            ->where('Acc', NULL)
                            ->where('Posisi', session()->get('Fungsi'))
                            ->set($data)
                            ->update();

        if(!$upd_spmb_acc) {
            return redirect()->back()
                            ->with('error', 'Gagal mengupdate SPMB_ACC');
        }

        // Jika radio-button tolak
        if($approval == 'tolak') {
            $query_no_urut = $spmb_acc_tbl->select('NoUrut')
                                ->where('SPMBNo', 'U1117415')
                                ->where('Acc', NULL)
                                ->where('Posisi', 'CFM')
                                ->get();
            if($query_no_urut->getNumRows() > 0) {
                $no_urut = null;
                foreach ($query_no_urut->getResult() as $key => $val) {
                    $no_urut = $val->NoUrut;
                }
            } else {
                return redirect()->back()
                                ->with('warning', 'Field NO_URUT tidak ditemukan');
            }

            $query_posisi = $spmb_acc_tbl->select('Posisi')
                                        ->where('SPMBNo', 'U1117415')
                                        ->where('NoUrut', $no_urut)
                                        ->get();
            if($query_posisi->getNumRows() > 0) {
                $posisi = null;
                foreach ($query_posisi->getResult() as $key => $val) {
                    $posisi = $val->Posisi;
                }
            } else {
                return redirect()->back()
                                ->with('warning', 'Field POSISI tidak ditemukan');
            }

            $spmb_acc_back_tbl = $this->db->table('SPMB_ACC_BACK');
            $data_acc_back = [
                'NoSPMB' => $spmbno,
                'BackTo' => $posisi
            ];

            if( ! $spmb_acc_tbl->insert($data)) {
                return redirect()->back()
                                ->with('error', 'Gagal meng-insert record pada SPMB_ACC_BACK');
            }
        }

        // UPDATE DB NLS
        if($approval == 'acc') {
            if((session()->get('Fungsi') == 'GM Peminta' && $kode_route < 73) || (session()->get('Fungsi') == 'Director' && $kode_route > 72)) {
                $statement = 'FINAL';
            } else {
                $statement = 'PROSES';
            }
        } elseif($approval == 'tolak') {
            $statement = 'TOLAK';
        } else {
            $statement = 'BATAL';
        }
        $nls_query = "sp_AccSPMB '".$statement."', ".$reqno.", ".$comp_id.",'PR', ''";
        if($this->db->simpleQuery($nls_query)) {
            return redirect()->to('/')
                            ->with('success', 'Antrian berhasil diupdate');
        } else {
            return redirect()->back()
                            ->with('error', 'Gagal mengupdate NLS data');
        }
    }

    private function dateConverter($date, $dateOnly = false)
    {
        $day = substr($date, 8, 2);
        $month = substr($date, 5, 2);
        $year = substr($date, 2, 2);
        $yearfull = substr($date, 2, 4);
        $hour = substr($date, 11, 2);
        $min = substr($date, 14, 2);

        if($dateOnly) {
            return $day . '-' . $month . '-' . $year;
        }

        return $day . '/' . $month . '/' . $year . ' ' . $hour . ':' . $min;
    }
}