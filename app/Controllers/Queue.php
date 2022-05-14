<?php

namespace App\Controllers;

class Queue extends BaseController
{

	public function sessi()
	{
		$data = [
			'Fungsi' => session()->get('Fungsi'),
			'KodeSPMB' => session()->get('KodeSPMB'),
			'Site' => session()->get('Site'),
			'CompId' => session()->get('CompId'),
			'DeptId' => session()->get('DeptId')
		];

		dd($data);
	}

	public function index()
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

		$query_deny = "spSPMBQueueTolak '".$fungsi."','".$kode_spmb."','".$site."','".$comp_id."','".$dept_id."'";
        $exc_deny_query = $this->db->simpleQuery($query_deny);
        do {
            $deny_res = [];
            while($deny_row = sqlsrv_fetch_array($exc_deny_query, SQLSRV_FETCH_ASSOC)) {
                $deny_res[] = $deny_row;
            }
        } while (sqlsrv_next_result($exc_deny_query));

		return view('Queue/main', [
			'page_title' => 'Antrian',
			'functions' => $this->getFungsi(),
			'auth' => $this->auth,
			'data' => $results,
			'deny' => $deny_res
		]);
	}

	public function apiGetProcess()
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

        $arrData = [];
        $arr_fungsi = ['PPSU', 'Perbekalan', 'CFM'];
        foreach ($results as $key => $val) {
        	$show_link = (in_array(session()->get('Fungsi'), $arr_fungsi) || substr(session()->get('Fungsi'), 0, 4) === 'Log ') ? 'detail' : 'acc';
            $arrData[] = [
                $key + 1,
                $val['Site'],
                $val['SPMBNo'],
                $val['Unit'],
                '<a href="' . site_url('status/' . $show_link . '/'.$val['SPMBNo']) . '">Tampilkan</a>'
            ];
        }

        $response = $arrData;

        return $this->response->setJSON($response);
    }

	public function apiGetDeny()
	{
		$fungsi = (session()->get('Fungsi') != null) ? session()->get('Fungsi') : '';
		$kode_spmb = (session()->get('KodeSPMB') != null) ? session()->get('KodeSPMB') : '';
		$site = session()->get('Site');
		$comp_id = (session()->get('CompId') != null) ? session()->get('CompId') : '';
		$dept_id = (session()->get('DeptId') != null) ? session()->get('DeptId') : '';

		$query_deny = "spSPMBQueueTolak '".$fungsi."','".$kode_spmb."','".$site."','".$comp_id."','".$dept_id."'";
        $exc_deny_query = $this->db->simpleQuery($query_deny);
        do {
            $results = [];
            while($deny_row = sqlsrv_fetch_array($exc_deny_query, SQLSRV_FETCH_ASSOC)) {
                $results[] = $deny_row;
            }
        } while (sqlsrv_next_result($exc_deny_query));

        $arrData = [];
        foreach ($results as $key => $val) {
            $arrData[] = [
                $key + 1,
                $val['Site'],
                $val['SPMBNo'],
                $val['Unit'],
                '<a href="' . site_url('status/acc/'.$val['SPMBNo']) . '">Tampilkan</a>'
            ];
        }

        $response = $arrData;

        return $this->response->setJSON($response);
	}

	public function acc()
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

		return view('Queue/acc', [
			'auth' => $this->auth,
			'data' => $results
		]);
	}
}