<?php

namespace App\Controllers;

class Users extends BaseController
{
	protected $auth;
    protected $db;
    protected $db2;
    protected $db3;

	public function __construct()
	{
		$this->auth = service('auth');
        $this->db = \Config\Database::connect($group = null);
        $this->db2 = \Config\Database::connect($group = 'orderEntryDb');
        $this->db3 = \Config\Database::connect($group = 'nls');
	}

	public function index()
	{
		return view('Users/main', [
			'auth' => $this->auth
		]);
	}
}