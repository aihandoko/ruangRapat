<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamModel extends Model
{
    protected $DBGroup = 'orderEntryDb'; 
    //protected $table = 'RR_Pinjam';
    //protected $userTimeStamps = true;
    //protected $allowedFields = ['bag','ruang','acara','peserta','ohp','lcd','wboard','flip','mic','air','teh','kopi','gula','creamer','kue','lunch','meja','ket','peminjam ','tgl','mulai ','selesai','status','durasi','inex'];


    public function getPinjam($no)
    {
        $query = $this->db->query("SELECT b.NamaLengkap nama, a.* FROM RR_Pinjam a, UserPass b  where a.peminjam=b.UserID and a.no='".$no."'");
        $result_array = $query->getResultArray();

        return $result_array;
    }


    public function getList($status)
    {
        $query = $this->db->query("SELECT * FROM RR_Pinjam  where tgl > dateadd(day,-6, getdate()) and isnull(status,'-')='".$status."' order by tgl asc");
        $result_array = $query->getResultArray();

        return $result_array;
    }


   

}