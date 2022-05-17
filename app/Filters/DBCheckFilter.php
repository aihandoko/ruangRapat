<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class DBCheckFilter implements FilterInterface
{
    // private $printing_info = [
    //     'UID' => env('database.default.username'),
    //     'PWD' => env('database.default.password'),
    //     'Database' => env('database.default.database'),
    //     'ReturnDatesAsStrings' => true,
    //     'CharacterSet' => "utf-8"
    // ];
    // private $orderEntryDb_info = [
    //     'UID' => env('database.orderEntryDb.username'),
    //     'PWD' => env('database.orderEntryDb.password'),
    //     'Database' => env('database.orderEntryDb.database'),
    //     'ReturnDatesAsStrings' => true,
    //     'CharacterSet' => "utf-8"
    // ];
    // private $nls_info = [
    //     'UID' => env('database.nls.username'),
    //     'PWD' => env('database.nls.password'),
    //     'Database' => env('database.nls.database'),
    //     'ReturnDatesAsStrings' => true,
    //     'CharacterSet' => "utf-8"
    // ];
    // private $local_info = [
    //     'UID' => env('database.local.username'),
    //     'PWD' => env('database.local.password'),
    //     'Database' => env('database.local.database'),
    //     'ReturnDatesAsStrings' => true,
    //     'CharacterSet' => "utf-8"
    // ];

    public function before(RequestInterface $request, $arguments = null)
    {
        // if( ! $this->default() || !$this->orderEntryDb() || !$this->nls() ) {
        if( ! $this->local() || ! $this->myNetwork() ) {

            $dbs = [];
            if( ! $this->local() ) $dbs[] = $this->local(true);
            if( ! $this->myNetwork() ) $dbs[] = $this->myNetwork(true);

            $response = service('response');
            $response->setStatusCode(500);
            $response->setBody(view('Common/db_no_connect', ['dbs' => $dbs]));

            return $response;
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

    // private function default()
    // {
    //     $hostname = env('database.default.hostname');
    //     $port = env('database.default.port');
    //     $conn = $this->printing_info;
    //     if($this->connect($hostname, $port, $conn) !== false) {
    //         return true;
    //     }

    //     return false;
    // }

    // private function orderEntryDb()
    // {
    //     $hostname = env('database.orderEntryDb.hostname');
    //     $port = env('database.orderEntryDb.port');
    //     $conn = $this->orderEntryDb_info;
    //     if($this->connect($hostname, $port, $conn) !== false) {
    //         return true;
    //     }

    //     return false;
    // }

    // private function nls()
    // {
    //     $hostname = env('database.nls.hostname');
    //     $port = env('database.nls.port');
    //     $conn = $this->nls_info;
    //     if($this->connect($hostname, $port, $conn) !== false) {
    //         return true;
    //     }

    //     return false;
    // }

    private function local($name = false)
    {
        if($name) {
            return 'local';
        }
        $local_info = [
        'UID' => env('database.local.username'),
        'PWD' => env('database.local.password'),
        'Database' => env('database.local.database'),
        'ReturnDatesAsStrings' => true,
        'CharacterSet' => "utf-8"
    ];
        $hostname = env('database.local.hostname');
        $port = env('database.local.port');
        $conn = $this->connect($hostname, $port, $local_info);
        if($conn!== false) {
            sqlsrv_close($conn);
            return true;
        } else {
            return false;
        }
    }

    private function myNetwork($name = false)
    {
        if($name) {
            return 'myNetwork';
        }

        $myNetwork_info = [
        'UID' => env('database.myNetwork.username'),
        'PWD' => env('database.myNetwork.password'),
        'Database' => env('database.myNetwork.database'),
        'ReturnDatesAsStrings' => true,
        'CharacterSet' => "utf-8"
    ];
        $hostname = env('database.myNetwork.hostname');
        $port = env('database.myNetwork.port');
        $conn = $this->connect($hostname, $port, $myNetwork_info);
        if($conn !== false) {
            sqlsrv_close($conn);
            return true;
        } else {
            return false;
        }
    }
}