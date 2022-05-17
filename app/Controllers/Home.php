<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $this->breadcrumbs->add('<i class="fas fa-home"></i>', '/');

        return view('Home/main', [
        	'page_title' => 'Dashbor',
        	'functions' => $this->getFungsi(),
        	'auth' => service('auth'),
            'breadcrumbs' => $this->breadcrumbs->render(),
        ]);
    }
}