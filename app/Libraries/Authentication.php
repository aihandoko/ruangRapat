<?php

namespace App\Libraries;

class Authentication {

    private $user;

    public function login($email, $password) {
        $model = new \App\Models\UsersModel;
        $user = $model->findByEmail($email);

        if($user === null) {
            return false;
        }

        if(!$user->verifyPassword($password)) {
            return false;
        }

        $session = session();
        $session->regenerate();
        $session->set('user_id', $user->id);

        return true;
    }

    public function logout() {
        session()->destroy();
    }

    public function getCurrentUser() {
        if(!$this->isLoggedIn()) {
            return null;
        }

        if($this->user === null) {
            $model = new \App\Models\UsersModel;

            $this->user = $model->find(session()->get('user_id'));
        }

        return $this->user;
    }

    public function isLoggedIn() {
        return session()->has('user_id');
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