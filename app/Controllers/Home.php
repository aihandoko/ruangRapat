<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('Home/main', [
        	'functions' => $this->getFungsi(),
        	'auth' => service('auth')
        ]);
    }
}