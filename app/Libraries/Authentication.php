<?php

namespace App\Libraries;

class Authentication
{
    protected $db;
    protected $db2;
    protected $db3;

    public function __construct()
    {
        $this->db = \Config\Database::connect($group = null);
        $this->db2 = \Config\Database::connect($group = 'orderEntryDb');
        $this->db3 = \Config\Database::connect($group = 'nls');
    }

    public function login($nik, $password)
    {
        // if($nik === 'alfin' || $nik === '96462') {
        //     $session = session();
        //     $session->regenerate();
        //     $session->set('selected_key', 0);
        //     $session->set('NIK', '075716');
        //     $session->set('Nama', 'Alfin Andri');
        //     $session->set('Fungsi', 'Admin');
        //     $session->set('Site', 'Palmerah');
        //     $session->set('KodeSPMB', 'PBD#UBD');
        //     $session->set('DeptId', '02071');
        //     $session->set('CompId', '020');

        //     return true;
        // } else {
        //     return false;
        // }

        $query = "spGetPwdValidation '".$nik."', '".$password."'";
        $exc_query = $this->db2->simpleQuery($query);
        do {
            $result = sqlsrv_fetch_array($exc_query, SQLSRV_FETCH_ASSOC);
        } while (sqlsrv_next_result($exc_query));

        if(!is_array($result) || $result[''] === 'NA') {
            return false;
        }

        $user_query = "select * from SPMB_ACC_USER where NIK='".$nik."'";
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
            $session->set('selected_key', 0);
            $session->set('NIK', $nik);
            $session->set('Nama', $results[0]['Nama']);
            $session->set('Fungsi', $results[0]['Fungsi']);
            $session->set('Site', $results[0]['Site']);
            $session->set('KodeSPMB', $results[0]['KodeSPMB']);
            $session->set('DeptId', $results[0]['DeptId']);
            $session->set('CompId', $results[0]['CompId']);
        } else {
            return false;
        }

        return true;
    }

    public function logout() {
        session()->destroy();
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

    public function isLoggedIn() {
        return session()->has('NIK');
    }

    public function api($json_data, $token_exp, $access_token = true)
    {
        $model = new \App\Models\UsersModel;
        $user = $model->findByEmail($json_data->email);

        if($user === null) {
            throw new \Exception('Pengguna tidak ditemukan', 400);
        }

        if(!$user->verifyPassword($json_data->password)) {
            throw new \Exception('Password salah', 401);
        }

        if(!$access_token) {
            return [
                'sub' => $user->id,
                'exp' => $token_exp['refresh_token']
            ];
        }

        return [
            'sub' => $user->id,
            'email' => $json_data->email,
            'name' => $user->name,
            'exp' => $token_exp['access_token']
        ];
    }

    public function getById($uid, $token_exp, $access_token = true)
    {
        $model = new \App\Models\UsersModel;
        $user = $model->find($uid);

        if($user === null) {
            throw new \Exception('Pengguna tidak ditemukan', 400);
        }

        if(!$access_token) {
            return [
                'sub' => $user->id,
                'exp' => $token_exp['refresh_token']
            ];
        }

        return [
            'sub' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'exp' => $token_exp['access_token']
        ];
    }
}