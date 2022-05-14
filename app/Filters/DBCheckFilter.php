<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class DBCheckFilter implements FilterInterface
{
    private $printing_info = [
        'UID' => env('database.default.username'),
        'PWD' => env('database.default.password'),
        'Database' => env('database.default.database'),
        'ReturnDatesAsStrings' => true,
        'CharacterSet' => "utf-8"
    ];
    private $orderEntryDb_info = [
        'UID' => env('database.orderEntryDb.username'),
        'PWD' => env('database.orderEntryDb.password'),
        'Database' => env('database.orderEntryDb.database'),
        'ReturnDatesAsStrings' => true,
        'CharacterSet' => "utf-8"
    ];
    private $nls_info = [
        'UID' => env('database.nls.username'),
        'PWD' => env('database.nls.password'),
        'Database' => env('database.nls.database'),
        'ReturnDatesAsStrings' => true,
        'CharacterSet' => "utf-8"
    ];

    public function before(RequestInterface $request, $arguments = null)
    {
        if( ! $this->default() || !$this->orderEntryDb() || !$this->nls() ) {
            
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }

    private function connect($hostname, $port, $conn_info)
    {
        return sqlsrv_connect($hostname . ', ' . $port, $conn_info);
    }

    private function default
    {
        $hostname = env('database.default.hostname');
        $port = env('database.default.port');
        $conn = $this->printing_info;
        if($this->connect($hostname, $port, $conn) !== false) {
            return true;
        }

        return false;
    }

    private function orderEntryDb
    {
        $hostname = env('database.orderEntryDb.hostname');
        $port = env('database.orderEntryDb.port');
        $conn = $this->orderEntryDb_info;
        if($this->connect($hostname, $port, $conn) !== false) {
            return true;
        }

        return false;
    }

    private function nls
    {
        $hostname = env('database.nls.hostname');
        $port = env('database.nls.port');
        $conn = $this->nls_info;
        if($this->connect($hostname, $port, $conn) !== false) {
            return true;
        }

        return false;
    }
}