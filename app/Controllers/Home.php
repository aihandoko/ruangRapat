<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('Home/main', [
        	'auth' => service('auth')
        ]);
    }
}