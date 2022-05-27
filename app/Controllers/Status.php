<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use App\Models\StatusModel;
use App\Libraries\Common;

class Status extends BaseController
{
    public function tes()
    {
        return view('Status/dummy', [
            'auth' => $this->auth
        ]);
    }

    /**
     * Method index yang ditampilkan /status
     * 
     * @return \CodeIgniter\View\View
     */
    public function index()
    {
        $this->breadcrumbs->add('<i class="fas fa-home"></i>', '/');
        $this->breadcrumbs->add('Status', '/status');

        return view('Status/main', [
            'page_title' => 'Status',
            'breadcrumbs' => $this->breadcrumbs->render(),
            'auth' => $this->auth
        ]);
    }

    /**
     * Method ini digunakan sebagai prototipe untuk merekonstruk
     * 
     * @return JSON
     */
    public function apiGetAll()
    {
        if($this->request->getMethod() != 'post') {
            return redirect()->to('/');
        }

        if($this->request->getPost('reload') != null && $this->request->getPost('reload')) {
            $clear_cache = true;
        } else {
            $clear_cache = false;
        }

        $response = (new StatusModel)->getDataStatus('spReadSPMBStatus2014', $clear_cache);

        return $this->response->setJSON($response);
    }

    /**
     * Method ini digunakan sebagai prototipe untuk merekonstruk
     * 
     * @return JSON
     */
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

        $sp = "spReadSPMBStatus2014_Parm '".$unit."','".$unit2."','".$no."','".$no2."','".$tahun."','".$tahun2."','".$deptId."'";
        $response = (new StatusModel)->getDataStatus($sp, true);

        return $this->response->setJSON($response);
    }

    public function detail($SPMBNo)
    {
        $this->breadcrumbs->add('<i class="fas fa-home"></i>', '/');
        $this->breadcrumbs->add('Antrian', '/queue');
        $this->breadcrumbs->add('Antrian ACC', '/queue');

        $status_model = new StatusModel;
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
            return view('Status/detail_not_found', [
                'page_title' => 'ACC SPMB',
                'auth' => $this->auth,
                'breadcrumbs' => $this->breadcrumbs->render(),
            ]);
        }

        /*
        * Req Dept dan Route dari DB PRINTING 
        * Route => select Route, DeptId from SPMB_ACC where SPMBNo=@SPMB
        * DeptName => select DeptName from SPMB_DEPT where DeptId=@DeptId
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

        return view('Status/detail', [
            'page_title' => 'ACC SPMB',
            'auth' => $this->auth,
            'data' => $results,
            'routes' => $routes,
            'DeptName' => $dept_name,
            'signature_name' => $signature_name,
            'signatures' => $signatures,
            'route_otorisasi' => implode(' > ', $route_otorisasi),
            'notes' => $notes,
            'SPMBNo' => $SPMBNo,
            'breadcrumbs' => $this->breadcrumbs->render(),
        ]);
    }

    public function updateAcc()
    {
        $SPMBNo = $this->request->getPost('SPMBNo');
        $Posisi = $this->request->getPost('Posisi');

        $table = $this->db->table('SPMB_ACC');
        $query = $table->where('SPMBNo', $SPMBNo)
                        ->where('Posisi', $Posisi)
                        ->set([
                            'Acc' => null,
                            'TglAcc' => null,
                            'Tolak' => null,
                            'Catatan' => null
                        ])
                        ->update();
        if($query) {
            return redirect()->back()
                            ->with('success', 'SPMB ' . $SPMBNo . ' berhasil diupdate');
        } else {
            return redirect()->back()
                            ->with('error', 'SPMB ' . $SPMBNo . ' berhasil diupdate');
        }
    }
}