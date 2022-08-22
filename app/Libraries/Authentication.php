<?php

namespace App\Libraries;

use App\Models\UsersModel;

class Authentication
{
    protected $db2;
    private $model;

    public function __construct()
    {
        $this->db2 = \Config\Database::connect($group = 'orderEntryDb');

        $this->model = new UsersModel();
    }


    public function login($nik, $password)
    {
        $query = "spGetPwdValidation '".$nik."', '".$password."'";
        $exc_query = $this->db2->simpleQuery($query);
        do {
            $result = sqlsrv_fetch_array($exc_query, SQLSRV_FETCH_ASSOC);
        } while (sqlsrv_next_result($exc_query));

        if(!is_array($result) || $result[''] === 'NA') {
            return false;
        }

        return $this->registerSession(0, $nik);
    }


    public function logout() {
        session()->destroy();
    }


    public function isLoggedIn() {
        return session()->has('NIK');
    }


    private function registerSession(int $key, $nik)
    {
        $query = $this->model->getUserByNIK($nik);

        if(count($query) > 0) {
            $session = session();
            // $session->regenerate();
            $session->set('NIK', $query[$key]->UserID);
            $session->set('Nama', $query[$key]->NamaLengkap);
            // session_write_close();

            return true;
        }

        return false;
    }

    public function getCurrentUser() {
        if(!$this->isLoggedIn()) {
            return null;
        }

        // if($this->user === null) {
        //     $model = new \App\Models\UsersModel;

        //     $this->user = $model->find(session()->get('user_id'));
        // }

        return $this->user;
    }
}