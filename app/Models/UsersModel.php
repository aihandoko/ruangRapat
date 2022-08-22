<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup = 'orderEntryDb'; 
    protected $table = 'UserPass';
    protected $allowedFields = ['UserID, NamaLengkap'];
   
    public function getUserByNIK($nik)
    {
        $query = $this->where('UserID', $nik)
                        ->get();

        if($query->getNumRows() > 0) {
            return $query->getResult();
        }

        return [];
    }

}