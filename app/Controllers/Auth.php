<?php

namespace App\Controllers;

// use App\Libraries\Common;
// use CodeIgniter\I18n\Time;
use Exception;

class Auth extends BaseController
{
    // protected $db;
    // protected $db2;
    // protected $db3;
    // protected $auth;

    // public function __construct()
    // {
    //     $this->db = \Config\Database::connect($group = null);
    //     $this->db2 = \Config\Database::connect($group = 'orderEntryDb');
    //     $this->db3 = \Config\Database::connect($group = 'nls');
    //     $this->auth = service('auth');
    // }

    public function login()
    {
        return view('login', [
            'auth' => $this->auth
        ]);
    }

    public function checkLogin()
    {
        $nik = $this->request->getPost('nik');
        $password = $this->request->getPost('password');

        $auth = service('auth');

        if($auth->login($nik, $password)) {
            $redirect = session('redirect_url') ?? '/';
            $success = true;
            $msg = 'Login berhasil';
            unset($_SESSION['redirect_url']);
            // return redirect()->to($redirect)
            //                 ->with('info', 'Login berhasil.');
        } else {
            $redirect = '';
            $success = false;
            $msg = 'Email atau password salah';
            // return redirect()->back()
            //                 ->withInput()
            //                 ->with('error', 'Email atau password salah.');
        }

        $response = [
            'success' => $success,
            'redirect' => $redirect,
            'msg' => $msg
        ];

        return $this->response->setJSON($response);
    }

    public function logout() {
        service('auth')->logout();

        return redirect()->to('login');
    }
}