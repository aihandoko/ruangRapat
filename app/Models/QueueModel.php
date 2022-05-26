<?php

namespace App\Models;

use CodeIgniter\Model;

class QueueModel extends Model
{
    // protected $DBGroup = 'local';
    protected $DBGroup = 'default';

    public function getQueues($sp, $queue_on_process = true, $clear_cache = false)
    {
    	if($queue_on_process) {
            if($clear_cache) {
                cache()->delete('dataQueue');
            }
            if( ! $dataQueue = cache('dataQueue')) {
                $dataQueue = $this->queueQuery($sp);
                cache()->save('dataQueue', $dataQueue, 1200);
            }
            $results = $dataQueue;
            $arr_fungsi = ['PPSU', 'Perbekalan', 'CFM'];
        } else {
            if($clear_cache) {
                cache()->delete('dataDenyQueue');
            }
            if( ! $dataDenyQueue = cache('dataDenyQueue')) {
                $dataDenyQueue = $this->queueQuery($sp);
                cache()->save('dataDenyQueue', $dataDenyQueue, 1200);
            }
            $results = $dataDenyQueue;            
        }

        $arrData = [];
        foreach ($results as $key => $val) {
        	if($queue_on_process) {
        		if(in_array(session()->get('Fungsi'), $arr_fungsi) ||
        			substr(session()->get('Fungsi'), 0, 4) === 'Log ') {
        			$tampilkan = '<a href="' . site_url('status/detail/'.$val['SPMBNo']) . '">Tampilkan</a>';
        		} else {
        			$tampilkan = '<a href="' . site_url('queue/acc/'.$val['SPMBNo']) . '">Tampilkan</a>';
        		}
        	} else {
        		$tampilkan = '<a href="' . site_url('queue/deny/'.$val['SPMBNo']) . '">Tampilkan</a>';
        	}

            $arrData[$key] = [
                $key + 1,
                $val['Site'],
                $val['SPMBNo'],
                $val['Unit'],
                $tampilkan
            ];

            if($queue_on_process && (in_array(session()->get('Fungsi'), $arr_fungsi) || substr(session()->get('Fungsi'), 0, 4) === 'Log ' || session()->get('Fungsi') == 'Logistic')) {
                $arrData[$key][5] = '<input class="form-check-input queue-check" type="checkbox" />';
            }
        }

        return $arrData;
    }

    private function queueQuery($sp)
    {
        $query = $this->db->simpleQuery($sp);
        do {
            $results = [];
            while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
        } while (sqlsrv_next_result($query));

        return $results;
    }
}