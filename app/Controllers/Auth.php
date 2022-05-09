<?php

namespace App\Controllers;

// use App\Libraries\Common;
// use CodeIgniter\I18n\Time;
// use Exception;

class Auth extends BaseController {

    public function login()
    {
        return view('login');
    }

    public function checkLogin()
    {
        $nik = $this->request->getPost('nik');
        $password = $this->request->getPost('password');

        $auth = service('auth');

        if($auth->login($nik, $password)) {
            $redirect = session('redirect_url') ?? '/';
            unset($_SESSION['redirect_url']);
            return redirect()->to($redirect)
                            ->with('info', 'Login berhasil.');
        } else {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Email atau password salah.');
        }
    }

    public function logout() {
        service('auth')->logout();

        return redirect()->to('login');
    }
}