<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    public function execute_sp($var1 = NULL,$var2 = NULL, $var3 = NULL, $var4 = NULL, $var5 = NULL, $var6 = NULL, $var7 = NULL)
    {
        $this->db = \Config\Database::connect($group = null, true);
        
        $sp = "spReadSPMBStatus2014_Parm ?,?,?,?,?,?,? "; //No exec or call needed
        
        //No @ needed.  Codeigniter gets it right either way
        $params = array(
        'PARAM_1' => NULL,
        'PARAM_2' => NULL,
        'PARAM_3' => NULL,
        'PARAM_4' => NULL,
        'PARAM_5' => NULL,
        'PARAM_6' => NULL,
        'PARAM_7' => NULL);
        
        $result = $this->db->query($sp,$params);
    }
}