<?php

namespace App\Controllers;

use App\Models\QueueModel;
use App\Libraries\Common;
use CodeIgniter\I18n\Time;

class Queue extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new QueueModel();
    }

	public function index()
	{
        $this->breadcrumbs->add('<i class="fas fa-home"></i>', '/');
        $this->breadcrumbs->add('Antrian', '/queue');

		return view('Queue/main', [
			'page_title' => 'Antrian',
            'breadcrumbs' => $this->breadcrumbs->render(),
			'auth' => $this->auth,
			// 'data' => $this->getQueue(),
			// 'deny' => $this->getDenyQueue()
		]);
	}

	public function apiGetProcess()
	{
        if($this->request->getMethod() != 'post') {
            return redirect()->to('/');
        }

        if($this->request->getPost('reload') != null && $this->request->getPost('reload')) {
            $clear_cache = true;
        } else {
            $clear_cache = false;
        }

		$fungsi = (session()->get('Fungsi') != null) ? session()->get('Fungsi') : '';
		$kode_spmb = (session()->get('KodeSPMB') != null) ? session()->get('KodeSPMB') : '';
		$site = session()->get('Site');
		$comp_id = (session()->get('CompId') != null) ? session()->get('CompId') : '';
		$dept_id = (session()->get('DeptId') != null) ? session()->get('DeptId') : '';

		$sp = "spSPMBQueue '".$fungsi."','".$kode_spmb."','".$site."','".$comp_id."','".$dept_id."'";

        $response = $this->model->getQueues($sp, true, $clear_cache);

        return $this->response->setJSON($response);
    }

	public function apiGetDeny()
	{
        if($this->request->getMethod() != 'post') {
            return redirect()->to('/');
        }
        
        if($this->request->getPost('reload') != null && $this->request->getPost('reload')) {
            $clear_cache = true;
        } else {
            $clear_cache = false;
        }

		$fungsi = (session()->get('Fungsi') != null) ? session()->get('Fungsi') : '';
		$kode_spmb = (session()->get('KodeSPMB') != null) ? session()->get('KodeSPMB') : '';
		$site = session()->get('Site');
		$comp_id = (session()->get('CompId') != null) ? session()->get('CompId') : '';
		$dept_id = (session()->get('DeptId') != null) ? session()->get('DeptId') : '';

		$sp = "spSPMBQueueTolak '".$fungsi."','".$kode_spmb."','".$site."','".$comp_id."','".$dept_id."'";

        $response = $this->model->getQueues($sp, false, $clear_cache);

        return $this->response->setJSON($response);
	}

    public function acc($SPMBNo)
    {
        $queue = $this->getQueue();
        $queue_val = array_map(function($val) {
            return trim($val['SPMBNo']);
        }, $queue);
        if(count($queue) == 0 || ! in_array($SPMBNo, $queue_val)) {
            return redirect()->to('/');
        }

        $this->breadcrumbs->add('<i class="fas fa-home"></i>', '/');
        $this->breadcrumbs->add('Antrian', '/queue');
        $this->breadcrumbs->add('Antrian ACC', '/queue');

        $status_model = new \App\Models\StatusModel();
        $common = new Common;

        /*
        * Select Dari DB NLS
        */
        $data = "select distinct a.ReqNo, a.ReqDate, a.CompId, a.DeptId, a.ReqDescription, a.AttachmentPath, b.AuthRoute, b.ReqSeqNo, b.ItemId, b.ItemQty, b.TargetDate, b.ReqNote, c.ItemName, d.UnitCode, b.AccountNo from Request_H a, Request_D b, Item c, Units d where a.ReqType='PR' and a.ReqType=b.ReqType and a.CompId=b.CompId  and a.ReqNo=b.ReqNo and b.ItemId=c.ItemId and c.CompId=rtrim(a.CompId) and c.UnitId=d.UnitId and rtrim(a.CompId)+'-'+CONVERT(VARCHAR,a.ReqNo) = '" . $SPMBNo . "'";
        $query = $this->db3->simpleQuery($data);
        do {
            $results = [];
            while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                $results[] = [
                    'ReqNo' => $row['ReqNo'],
                    'ReqDate' => $common->dateConverter($row['ReqDate'], true),
                    'CompId' => $row['CompId'],
                    'DeptId' => $row['DeptId'],
                    'ReqDescription' => $row['ReqDescription'],
                    'AttachmentPath' => $row['AttachmentPath'],
                    'AuthRoute' => $row['AuthRoute'],
                    'ReqSeqNo' => $row['ReqSeqNo'],
                    'ItemId' => $row['ItemId'],
                    'ItemQty' => $row['ItemQty'],
                    'TargetDate' => $common->dateConverter($row['TargetDate'], true),
                    'ReqNote' => $row['ReqNote'],
                    'ItemName' => $row['ItemName'],
                    'UnitCode' => $row['UnitCode'],
                    'AccountNo' => $row['AccountNo'],
                ];
            }
        } while (sqlsrv_next_result($query));

        if(count($results) == 0) {

            $query = $this->db->query("update SPMB_ACC set Batal=1 where SPMBNo= '" . $SPMBNo . "'");
            $result_array = $query->getResultArray();
            return $result_array;

            return view('Status/detail_not_found', [
                'page_title' => 'ACC SPMB',
                'auth' => $this->auth,
                'breadcrumbs' => $this->breadcrumbs->render(),
            ]);
        }


        /*
        * Ambil Dept ID  Cost Ctr dari DB NLS
        */
        $data_cct = "select distinct a.DeptId from Request_H a, Request_D b, Item c, Units d where a.ReqType='PR' and a.ReqType=b.ReqType and a.CompId=b.CompId  and a.ReqNo=b.ReqNo and b.ItemId=c.ItemId and c.CompId=rtrim(a.CompId) and c.UnitId=d.UnitId and rtrim(a.CompId)+'-'+CONVERT(VARCHAR,a.ReqNo) = '" . $SPMBNo . "'";
        $query_cct = $this->db3->simpleQuery($data_cct);
        do {
            while($row_cct = sqlsrv_fetch_array($query_cct, SQLSRV_FETCH_ASSOC)) {
                $dept_cct = $row_cct['DeptId'];
            }
            $dept_name_cct = $status_model->getDeptNameByDeptId( $dept_cct );
        } while (sqlsrv_next_result($query_cct));

        //dd($dept_cct);

        /*
        * Dept ID Req Dept dan Kode Routing dari DB PRINTING
        */
        $routes = $status_model->getRoutesBySPMBNo( $SPMBNo );

        if(count($routes) > 0 && $routes[0]->DeptId != null) {
            $dept_name = $status_model->getDeptNameByDeptId( $routes[0]->DeptId );
        } else {
            $dept_name = '';
        }

        /*
        * ROUTE OTORISASI
        * dari select Site, Route, DeptId from SPMB_ACC where SPMBNo = @SPMBNo
        */        
        if(count($results) > 0) {
            //$route_auth = "select * from SPMB_ACC_ROUTE where Kode='".$results[0]['AuthRoute']."'";  <- msh dari NLS
            $route_auth = "select * from SPMB_ACC_ROUTE where Kode= '" . $routes[0]->Route . "'";
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

        /*
        * OTORISASI (TANDA TANGAN)
        * dari select a.Acc, b.Nama, a.TglAcc, a.Posisi, isnull(a.Tolak,0) Tolak, isnull(a.Batal,0) Batal
        * from SPMB_ACC a, SPMB_ACC_USER b where a.Acc is not null and a.SPMBNo =@SPMB and where b.NIK=a.Acc
        * (SUDAH DIREVISI)
        *
        */
        $signatures = $status_model->getSignatures( $SPMBNo );
        $signature_name = $status_model->getSignatureName( $signatures[0]->Acc );

        /*
        * CATATAN-CATATAN
        * dari select Posisi, Catatan from SPMB_ACC where SPMBNo =@SPMB order by NoUrut Desc
        */
        $notes = $status_model->getNotes( $SPMBNo );

        return view('Queue/acc', [
            'page_title' => 'ACC SPMB',
            'breadcrumbs' => $this->breadcrumbs->render(),
            'auth' => $this->auth,
            'data' => $results,
            'routes' => $routes,
            'DeptName' => $dept_name,
            'DeptNameCCt' => $dept_name_cct ,
            'DeptCCt' => $dept_cct ,
            'signature_name' => $signature_name,
            'signatures' => $signatures,
            'TglAcc' => $common->dateConverter($signatures[0]->TglAcc),
            'route_otorisasi' => implode(' > ', $route_otorisasi),
            'route_kode' => $results[0]['AuthRoute'],
            'notes' => $notes,
            'SPMBNo' => $SPMBNo
        ]);
    }

    // ACC ANTRIAN PROSES
    public function accProcess()
    {
        $acc_notes = $this->request->getPost('acc_notes');
        $approval = $this->request->getPost('approval');
        $reqno = (int)$this->request->getPost('reqno');
        $compid = (int)$this->request->getPost('compid');
        $spmbno = $this->request->getPost('spmbno');
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
        $nls_query = "sp_AccSPMB '".$statement."', ".$reqno.", ".$compid.",'PR', ''";
        if($this->db3->simpleQuery($nls_query)) {

            cache()->delete('dataQueue');

            return redirect()->to('/')
                            ->with('success', 'Antrian berhasil diupdate');
        } else {
            return redirect()->back()
                            ->with('error', 'Gagal mengupdate NLS data');
        }

    }

    public function deny($SPMBNo)
    {
        // $queue = (new \App\Controllers\Queue())->getQueue();
        // $queue_val = array_map(function($val) {
        //     return trim($val['SPMBNo']);
        // }, $queue);
        // if(count($queue) == 0 || ! in_array($SPMBNo, $queue_val)) {
        //     return redirect()->to('/');
        // }

        $this->breadcrumbs->add('<i class="fas fa-home"></i>', '/');
        $this->breadcrumbs->add('Antrian', '/queue');
        $this->breadcrumbs->add('Antrian ACC', '/queue');

        $status_model = new \App\Models\StatusModel();
        $common = new Common;

        /*
        * Select Dari DB NLS
        */
        $data = "select distinct a.ReqNo, a.ReqDate, a.CompId, a.DeptId, a.ReqDescription, a.AttachmentPath, b.AuthRoute, b.ReqSeqNo, b.ItemId, b.ItemQty, b.TargetDate, b.ReqNote, c.ItemName, d.UnitCode, b.AccountNo from Request_H a, Request_D b, Item c, Units d where a.ReqType='PR' and a.ReqType=b.ReqType and a.CompId=b.CompId  and a.ReqNo=b.ReqNo and b.ItemId=c.ItemId and c.CompId=rtrim(a.CompId) and c.UnitId=d.UnitId and rtrim(a.CompId)+'-'+CONVERT(VARCHAR,a.ReqNo) = '" . $SPMBNo . "'";
        $query = $this->db3->simpleQuery($data);
        do {
            $results = [];
            while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                $results[] = [
                    'ReqNo' => $row['ReqNo'],
                    'ReqDate' => $common->dateConverter($row['ReqDate'], true),
                    'CompId' => $row['CompId'],
                    'DeptId' => $row['DeptId'],
                    'ReqDescription' => $row['ReqDescription'],
                    'AttachmentPath' => $row['AttachmentPath'],
                    'AuthRoute' => $row['AuthRoute'],
                    'ReqSeqNo' => $row['ReqSeqNo'],
                    'ItemId' => $row['ItemId'],
                    'ItemQty' => $row['ItemQty'],
                    'TargetDate' => $common->dateConverter($row['TargetDate'], true),
                    'ReqNote' => $row['ReqNote'],
                    'ItemName' => $row['ItemName'],
                    'UnitCode' => $row['UnitCode'],
                    'AccountNo' => $row['AccountNo'],
                ];
            }
        } while (sqlsrv_next_result($query));

        if(count($results) == 0) {

            $query = $this->db->query("update SPMB_ACC set Batal=1 where SPMBNo= '" . $SPMBNo . "'");
            $result_array = $query->getResultArray();
            return $result_array;
            
            return view('Status/detail_not_found', [
                'page_title' => 'ACC SPMB',
                'auth' => $this->auth,
                'breadcrumbs' => $this->breadcrumbs->render(),
            ]);
        }

        /*
        * Ambil Dept ID  Cost Ctr dari DB NLS
        */
        $data_cct = "select distinct a.DeptId from Request_H a, Request_D b, Item c, Units d where a.ReqType='PR' and a.ReqType=b.ReqType and a.CompId=b.CompId  and a.ReqNo=b.ReqNo and b.ItemId=c.ItemId and c.CompId=rtrim(a.CompId) and c.UnitId=d.UnitId and rtrim(a.CompId)+'-'+CONVERT(VARCHAR,a.ReqNo) = '" . $SPMBNo . "'";
        $query_cct = $this->db3->simpleQuery($data_cct);
        do {
            while($row_cct = sqlsrv_fetch_array($query_cct, SQLSRV_FETCH_ASSOC)) {
                $dept_cct = $row_cct['DeptId'];
            }
            $dept_name_cct = $status_model->getDeptNameByDeptId( $dept_cct );
        } while (sqlsrv_next_result($query_cct));

        //dd($dept_cct);
       
        /*
        * Dept ID Req Dept dan Kode Routing dari DB PRINTING
        */
        $routes = $status_model->getRoutesBySPMBNo( $SPMBNo );

        if(count($routes) > 0 && $routes[0]->DeptId != null) {
            $dept_name = $status_model->getDeptNameByDeptId( $routes[0]->DeptId );
        } else {
            $dept_name = '';
        }

        /*
        * ROUTE OTORISASI
        * dari select Site, Route, DeptId from SPMB_ACC where SPMBNo = @SPMBNo
        */        
        if(count($results) > 0) {
            //$route_auth = "select * from SPMB_ACC_ROUTE where Kode='".$results[0]['AuthRoute']."'";  <- msh dari NLS
            $route_auth = "select * from SPMB_ACC_ROUTE where Kode= '" . $routes[0]->Route . "'";
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

        /*
        * OTORISASI (TANDA TANGAN)
        * dari select a.Acc, b.Nama, a.TglAcc, a.Posisi, isnull(a.Tolak,0) Tolak, isnull(a.Batal,0) Batal
        * from SPMB_ACC a, SPMB_ACC_USER b where a.Acc is not null and a.SPMBNo =@SPMB and where b.NIK=a.Acc
        * (SUDAH DIREVISI)
        *
        */
        $signatures = $status_model->getSignatures( $SPMBNo );
        $signature_name = $status_model->getSignatureName( $signatures[0]->Acc );

        /*
        * CATATAN-CATATAN
        * dari select Posisi, Catatan from SPMB_ACC where SPMBNo =@SPMB order by NoUrut Desc
        */
        $notes = $status_model->getNotes( $SPMBNo );

        return view('Queue/deny', [
            'page_title' => 'ACC SPMB',
            'breadcrumbs' => $this->breadcrumbs->render(),
            'auth' => $this->auth,
            'data' => $results,
            'routes' => $routes,
            'DeptName' => $dept_name,
            'DeptNameCCt' => $dept_name_cct ,
            'DeptCCt' => $dept_cct ,
            'signature_name' => $signature_name,
            'signatures' => $signatures,
            'TglAcc' => $common->dateConverter($signatures[0]->TglAcc),
            'route_otorisasi' => implode(' > ', $route_otorisasi),
            'route_kode' => $results[0]['AuthRoute'],
            'notes' => $notes,
            'SPMBNo' => $SPMBNo
        ]);
    }

    // DENY ANTRIAN PROSES
    public function denyProcess()
    {
        $acc_notes = $this->request->getPost('acc_notes');
        $approval = $this->request->getPost('approval');
        $reqno = (int)$this->request->getPost('reqno');
        $compid = (int)$this->request->getPost('compid');
        $spmbno = (int)$this->request->getPost('spmbno');
        $site = $this->request->getPost('site');
        $kode_route = (int)$this->request->getPost('kode_route');

        // if($approval == 'acc') {
        //     $Tolak = 0;
        //     $Batal = 0;
        // } elseif($approval == 'tolak') {
        //     $Tolak = 1;
        //     $Batal = 0;
        // } else {
        //     $Tolak = 0;
        //     $Batal = 1;
        // }

        $now = (Time::now())->toDateTimeString();

        $query1 = $this->db->table('SPMB_ACC')
                            ->selectMax('NoUrut')
                            ->where('SPMBNo', $spmbno)
                            ->get();
        $NoUrut = $query1->getFirstRow()->NoUrut;

        $data_tolak = [
            'SPMBNo' => $spmbno,
            'Site' => $site,
            'Route' => $kode_route,
            'NoUrut' => $NoUrut,
            'Posisi' => session()->get('Posisi'),
            'Acc' => session()->get('NIK'),
            'TglAcc' => $now,
            'Catatan' => $acc_notes,
            'Tolak' => $Tolak,
            'TglPO' => ''
        ];
        $query2 = $this->db->table('SPMB_ACC_TOLAK')
                            ->insert($data_tolak);

        $query3 = $this->db->table('SPMB_ACC')
                            ->select('SPMBNo, Site, Route, NoUrut, Posisi, Acc, TglAcc, Catatan, Tolak, TglPO')
                            ->where('SPMBNo', $spmbno)
                            ->where('NoUrut', $NoUrut)
                            ->get()
                            ->getFirstRow();

        $query4 = $this->db->table('SPMB_ACC')
                            ->where('SPMBNo', $spmbno)
                            ->where('NoUrut', $NoUrut)
                            ->delete();

       // PROSES H dan I

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
                                ->where('SPMBNo', $spmbno)
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
                                        ->where('SPMBNo', $spmbno)
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
        if($this->db3->simpleQuery($nls_query)) {

            cache()->delete('dataQueue');
            
            return redirect()->to('/')
                            ->with('success', 'Antrian berhasil diupdate');
        } else {
            return redirect()->back()
                            ->with('error', 'Gagal mengupdate NLS data');
        }
    }

    public function getQueue()
    {
        $fungsi = (session()->get('Fungsi') != null) ? session()->get('Fungsi') : '';
        $kode_spmb = (session()->get('KodeSPMB') != null) ? session()->get('KodeSPMB') : '';
        $site = session()->get('Site');
        $comp_id = (session()->get('CompId') != null) ? session()->get('CompId') : '';
        $dept_id = (session()->get('DeptId') != null) ? session()->get('DeptId') : '';

        $query = "spSPMBQueue '".$fungsi."','".$kode_spmb."','".$site."','".$comp_id."','".$dept_id."'";
        $exc_query = $this->db->simpleQuery($query);
        do {
            $results = [];
            while($row = sqlsrv_fetch_array($exc_query, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
        } while (sqlsrv_next_result($exc_query));

        return $results;
    }

    public function getDenyQueue()
    {
        $fungsi = (session()->get('Fungsi') != null) ? session()->get('Fungsi') : '';
        $kode_spmb = (session()->get('KodeSPMB') != null) ? session()->get('KodeSPMB') : '';
        $site = session()->get('Site');
        $comp_id = (session()->get('CompId') != null) ? session()->get('CompId') : '';
        $dept_id = (session()->get('DeptId') != null) ? session()->get('DeptId') : '';

        $query_deny = "spSPMBQueueTolak '".$fungsi."','".$kode_spmb."','".$site."','".$comp_id."','".$dept_id."'";
        $exc_deny_query = $this->db->simpleQuery($query_deny);
        do {
            $deny_res = [];
            while($deny_row = sqlsrv_fetch_array($exc_deny_query, SQLSRV_FETCH_ASSOC)) {
                $deny_res[] = $deny_row;
            }
        } while (sqlsrv_next_result($exc_deny_query));

        return $deny_res;
    }

    //untuk hapus SPMB yg tidak ada di NLS dan belum ACC
    public function spmbNoNLS()
    {
        // Ambil semua PR NLS
        $queryNLS = "select CompId +'-'+ string(ReqNo) NoPR from Request_H where ReqType='PR' and CompId in ('020','422','425','500','527','645','650','660','663','672','674') order by NoPR ";
        $exc_queryNLS = $this->db3->simpleQuery($queryNLS);
       
        do {
            $resultsNLS = [];
            while($rowNLS = sqlsrv_fetch_array($exc_queryNLS, SQLSRV_FETCH_ASSOC)) {
                $resultsNLS[] = $rowNLS;
            }
        } while (sqlsrv_next_result($exc_queryNLS));

        return $resultsNLS;
        //belum selesai
    }

}