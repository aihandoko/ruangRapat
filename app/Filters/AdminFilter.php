<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null)
    {
        if ( session()->get('Fungsi') !== 'Admin' ) {
            $response = service('response');
            $response->setStatusCode(403);
            $response->setBody('You do not allowed to access this resource.');

            return $response;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}