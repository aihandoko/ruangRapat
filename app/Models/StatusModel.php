<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    // protected $DBGroup = 'local';
    protected $DBGroup = 'default';
    private $sp_GetAllStatus = 'spReadSPMBStatus2014';

    public function getDataStatus($sp, $clear_cache = false)
    {
        if($clear_cache) {
            cache()->delete('dataStatus');
        }

        if( ! $dataStatus = cache('dataStatus')) {
        	$query = $this->db->simpleQuery($sp);
        	do {
                $key = 0;
        		$results = [];
        		while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
	    			$results[$key] = [
	                    $key + 1,
	                    '<a href="' . site_url('status/detail/'.$row['SPMBNo']) . '">' . $row['SPMBNo'] . '</a>',
	                    $row['Site'],
	                    $this->stepWithDate($row['Step1'], $row['ACC1']),
	                    $this->stepWithDate($row['Step2'], $row['ACC2']),
	                    $this->stepWithDate($row['Step3'], $row['ACC3']),
	                    $this->stepWithDate($row['Step4'], $row['ACC4']),
	                    $this->stepWithDate($row['Step5'], $row['ACC5']),
	                    $this->stepWithDate($row['Step6'], $row['ACC6']),
	                    $this->stepWithDate($row['Step7'], $row['ACC7']),
	    			];
	    			if(session()->get('Fungsi') == 'Admin') {
		    			$results[$key][10] = $this->posisiSelectBox($row['SPMBNo']);
		    		}
                    $key++;
	    	  }
            } while (sqlsrv_next_result($query));

            $dataStatus = $results;

            cache()->save('dataStatus', $dataStatus, 1200);
        }

        return $dataStatus;
    }

    public function getRoutesBySPMBNo($SPMBNo)
    {
    	$table = $this->db->table('SPMB_ACC');
    	$query = $table->select('Site, Route, DeptId')
    					->where('SPMBNo', $SPMBNo)
    					->get();
    	if($query->getNumRows() > 0) {
            return $query->getResult();
    	}
        return [];
    }

    public function getDeptNameByDeptId($DeptId)
    {
        $table = $this->db->table('SPMB_DEPT');
        $query = $table->select('DeptName')
                        ->where('DeptId', $DeptId)
                        ->get();
        if($query->getNumRows() > 0) {
            return $query->getResult()[0]->DeptName;
        }
        return '';
    }

    public function getRouteOtorisasi($AuthRoute)
    {
        $table = $this->db->table('SPMB_ACC_ROUTE');
        $query = $table->where('Kode', $AuthRoute)
                        ->get();
        if($query->getNumRows() > 0) {
            return $query->getResult()[0]->DeptName;
        }
        return '';   
    }

    public function getSignatures($SPMBNo)
    {
        $table = $this->db->table('SPMB_ACC');
        $query = $table->select('Acc, TglAcc, Posisi, isnull(Tolak,0) Tolak, isnull(Batal,0) Batal')
                        ->where('SPMBNo', $SPMBNo)
                        ->get();
        if($query->getNumRows() > 0) {
            return $query->getResult();
        }

        return [];
    }

    public function getSignatureName($NIK)
    {
        $table = $this->db->table('SPMB_ACC_USER');
        $query = $table->select('Nama')
                        ->where('NIK', $NIK)
                        ->get();
        if($query->getNumRows() > 0) {
            foreach ($query->getResult() as $value) {
                $nama = $value->Nama;
            }
            return $nama;
        } else {
            return '';
        }
    }

    public function getNotes($SPMBNo)
    {
        $table = $this->db->table('SPMB_ACC');
        $query = $table->select('Posisi, Catatan')
                        ->where('SPMBNo', $SPMBNo)
                        ->orderBy('NoUrut', 'desc')
                        ->get();
        if($query->getNumRows() > 0) {
            return $query->getResult();
        }

        return [];
    }

    private function posisiSelectBox($SPMBNo)
    {
    	$table = $this->db->table('SPMB_ACC');
    	$query = $table->select('Posisi')
    					->where('SPMBNo', $SPMBNo)
    					->orderBy('NoUrut', 'asc')
    					->get();
    	if($query->getNumRows() > 0) {
    		$options = [];
    		foreach($query->getResult() as $r) {
    			$options[] = '<option value="'.$r->Posisi.'">'.$r->Posisi.'</option>';
    		}
    		$select = form_open('status/updateAcc') . '<select name="Posisi" class="form-control custom-form d-inline">' . implode('', $options) . '</select><input type="hidden" name="SPMBNo" value="'.$SPMBNo.'" /> <button type="submit" name="submit" class="btn btn-danger btn-sm pt-0 pb-0" onClick="return confirm(\'Yakin menghapus\')"><i class="fas fa-times"></i></button</form>';
    	} else {
    		$select = '';
    	}

    	return $select;
    }

    private function stepWithDate($step, $acc)
    {
    	return $this->nullToEmptySpace($step) . $this->nullToDateConverted($acc);
    }

    private function nullToEmptySpace($step)
    {
    	return ($step != null) ? $step : '';
    }

    private function nullToDateConverted($acc)
    {
    	return ($acc != null) ? '<div>' . $this->dateConverter($acc) . '</div>' : '';
    }

    private function dateConverter($date, $dateOnly = false)
    {
        $day = substr($date, 8, 2);
        $month = substr($date, 5, 2);
        $year = substr($date, 2, 2);
        $yearfull = substr($date, 2, 4);
        $hour = substr($date, 11, 2);
        $min = substr($date, 14, 2);

        if($dateOnly) {
            return $day . '-' . $month . '-' . $year;
        }

        return $day . '/' . $month . '/' . $year . ' ' . $hour . ':' . $min;
    }

    // public function getAll()
    // {
    // 	$query = $this->db->query('GetAllUsers');
    // 	if($query->getNumRows() > 0) {
    // 		$results = [];
    // 		foreach($query->getResult() as $key => $row) {
	   //  		$results[$key] = [
	   //  			$row->Nama,
	   //  			$row->NIK,
	   //  		];
    // 			if(session()->get('Fungsi') == 'Admin') {
	   //  			$results[$key][3] = $row->CompId;
	   //  		}
    // 		}
    // 		return $results;
    // 	} else {
    // 		return [];
    // 	}
    // }
}