<?php

namespace App\Controllers;

/**
 * 
 */
class Fungsi extends BaseController
{
	protected $auth;
    protected $db;
    protected $db2;
    protected $db3;

	public function __construct()
	{
		$this->auth = service('auth');
        $this->db = \Config\Database::connect($group = null);
        $this->db2 = \Config\Database::connect($group = null);
        $this->db3 = \Config\Database::connect($group = 'nls');
	}

	public function switch()
	{
		$query = "select * from SPMB_ACC_USER where NIK = '" . session()->get('NIK') . "'";
        $exc_query = $this->db->simpleQuery($query);
        do {
            $results = [];
            while($row = sqlsrv_fetch_array($exc_query, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
        } while (sqlsrv_next_result($exc_query));

		return view('Fungsi/switch', [
			'auth' => $this->auth,
			'functions' => $results
		]);
	}

	public function process()
	{
		$fungsi = (int)$this->request->getPost('fungsi');

		$user_query = "select * from SPMB_ACC_USER where NIK='".session()->get('NIK')."'";
        $exc_user_query = $this->db->simpleQuery($user_query);
        if(sqlsrv_num_rows($exc_user_query) > 0) {
            do {
                $results = [];
                while($row = sqlsrv_fetch_array($exc_user_query, SQLSRV_FETCH_ASSOC)) {
                    $results[] = $row;
                }
            } while (sqlsrv_next_result($exc_user_query));

            $session = session();
            $session->regenerate();
            $session->set('selected_key', $fungsi);
            $session->set('Fungsi', $results[$fungsi]['Fungsi']);
            $session->set('Site', $results[$fungsi]['Site']);
            $session->set('KodeSPMB', $results[$fungsi]['KodeSPMB']);
            $session->set('DeptId', $results[$fungsi]['DeptId']);
            $session->set('CompId', $results[$fungsi]['CompId']);

            return redirect()->back()->with('success', 'Session berhasil dirubah');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
	}
}