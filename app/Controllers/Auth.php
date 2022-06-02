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

    public function verifyLogin()
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
            unset($_SESSION['redirect_url']);
            return redirect()->to($redirect);
        } else {
            $redirect = '';
            $success = false;
            $msg = 'Email atau password salah';
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Email atau password salah.');
        }
    }

    public function logout() {
        cache()->delete('dataStatus');
        cache()->delete('dataQueue');
        cache()->delete('dataDenyQueue');
        cache()->delete('dataUsers');

        service('auth')->logout();

        return redirect()->to('login');
    }

    public function changeFungsi()
    {
        $fungsi = (int)$this->request->getPost('key');

        if($this->auth->changeFungsi(session()->get('NIK'), $fungsi)) {
            
            cache()->delete('dataStatus');
            cache()->delete('dataQueue');
            cache()->delete('dataDenyQueue');
            cache()->delete('dataUsers');

            session()->setFlashdata('flash_success', 'Fungsi diubah ke <strong>' . session()->get('Fungsi') . '</strong>.');

            $response = [
                'success' => true,
                'selected_key' => $fungsi,
                'Fungsi' => session()->get('Fungsi'),
                'Site' => session()->get('Site'),
                'current_url' => current_url()
            ];
        } else {
            
            session()->setFlashdata('flash_error', 'Fungsi gagal diubah');

            $response = [
                'success' => false,
                'key' => $fungsi
            ];
        }

        return $this->response->setJSON($response);
    }
}