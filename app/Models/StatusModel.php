<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $DBGroup = 'local';
    // protected $DBGroup = 'default';

    // public function getAll()
    // {
    // 	$query = $this->db->query('spReadSPMBStatus2014');
    // 	if($query->getNumRows() > 0) {
    // 		$results = [];
    // 		foreach($query->getResult() as $row) {
    // 			$results[] = [
    // 			];
    // 		}
    // 	}
    // 	return $query->getResult();
    // }

    public function getAll()
    {
    	$query = $this->db->query('GetAllUsers');
    	if($query->getNumRows() > 0) {
    		$results = [];
    		foreach($query->getResult() as $row) {
    			$results[] = [
    				$row->Nama,
    				$row->NIK,
    				$row->Fungsi
    			];
    		}
    		return $results;
    	} else {
    		return [];
    	}
    }
}