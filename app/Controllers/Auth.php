<?php

namespace App\Controllers;

class Auth extends BaseController
{
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
            cache()->delete('dataStatus');
            cache()->delete('dataQueue');
            cache()->delete('dataDenyQueue');
            cache()->delete('dataUsers');
            $redirect = session('redirect_url') ?? '/';
            $success = true;
            $msg = 'Login berhasil';
            unset($_SESSION['redirect_url']);
        } else {
            $redirect = '';
            $success = false;
            $msg = 'NIK atau password salah';
        }

        $response = [
            'success' => $success,
            'redirect' => $redirect,
            'msg' => $msg
        ];

        return $this->response->setJSON($response);
    }

    public function logout() {
        cache()->delete('dataStatus');
        cache()->delete('dataQueue');
        cache()->delete('dataDenyQueue');
        cache()->delete('dataUsers');

        service('auth')->logout();

        return redirect()->to('login');
    }

}