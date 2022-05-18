<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'SPMB_ACC_USER';
    protected $allowedFields = ['NIK', 'Nama', 'Fungsi', 'Site', 'KodeSPMB', 'DeptId', 'CompId'];
    protected $validationRules = [
        'NIK' => 'required',
        'Nama' => 'required',
        'Fungsi' => 'required',
        'Site' => 'required',
    ];
    protected $validationMessages = [
        'NIK'        => [
            'required' => 'Field NIK harus diisi.',
        ],
        'Nama'        => [
            'required' => 'Field Nama harus diisi.',
        ],
        'Fungsi'        => [
            'required' => 'Field Fungsi harus dipilih.',
        ],
        'Site'        => [
            'required' => 'Field Site harus dipilih.',
        ],
    ];

    public function getByParams($nik, $nama, $fungsi, $site)
    {
        $fungsi = ($fungsi == 'null') ? null : $fungsi;
        $site = ($site == 'null') ? null : $site;
        return $this->where('NIK', $nik)
                    ->where('Nama', $nama)
                    ->where('Fungsi', $fungsi)
                    ->where('Site', $site)
                    ->get();
    }

    public function destroy($nik, $nama, $fungsi, $site)
    {
        $fungsi = ($fungsi == 'null') ? null : $fungsi;
        $site = ($site == 'null') ? null : $site;
        return $this->where('NIK', $nik)
                    ->where('Nama', $nama)
                    ->where('Fungsi', $fungsi)
                    ->where('Site', $site)
                    ->delete();
    }

    public function updateByParams(array $params, array $data)
    {
        return $this->where('NIK', $params['NIK'])
                    ->where('Nama', $params['Nama'])
                    ->where('Fungsi', $params['Fungsi'])
                    ->where('Site', $params['Site'])
                    ->set($data)
                    ->update();
    }

    public function getFungsi()
    {
        return $this->select('Fungsi')
                    ->where('Fungsi !=', NULL)
                    ->orderBy('Fungsi', 'asc')
                    ->distinct()
                    ->get();
    }

    public function getSites()
    {
        return $this->select('Site')
                    ->where('Site !=', NULL)
                    ->orderBy('Site', 'asc')
                    ->distinct()
                    ->get();

    }
}