<?php

namespace App\Controllers\Apis;

use CodeIgniter\RESTful\ResourceController;

class Status extends ResourceController
{
	public function getAll()
	{
		// $limit = $this->request->getGet('length');
  //       $offset = $this->request->getGet('start');

		$source = [
            [
                'SPMBNo' => '645-20367',
                'KodeRouting' => 72,
                'Site' => 'Cikarang',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Step8' => null,
                'Step9' => null,
                'Step10' => null,
                'Step11' => null,
                'ACC1' => null,
                'ACC2' => null,
                'ACC3' => null,
                'ACC4' => null,
                'ACC5' => null,
                'ACC6' => null,
                'ACC7' => null,
                'ACC8' => null,
                'ACC9' => null,
                'ACC10' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '645-20366',
                'KodeRouting' => 72,
                'Site' => 'Cikarang',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '645-20365',
                'KodeRouting' => 72,
                'Site' => 'Cikarang',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '527-13299',
                'KodeRouting' => 71,
                'Site' => 'Surabaya',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'CFM',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '527-13298',
                'KodeRouting' => 72,
                'Site' => 'Surabaya',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '527-13297',
                'KodeRouting' => 72,
                'Site' => 'Surabaya',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '527-13296',
                'KodeRouting' => 72,
                'Site' => 'Surabaya',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '645-20364',
                'KodeRouting' => 71,
                'Site' => 'Cikarang',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'CFM',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '645-20363',
                'KodeRouting' => 71,
                'Site' => 'Cikarang',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'CFM',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '650-15768',
                'KodeRouting' => 71,
                'Site' => 'Bandung1',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '645-20362',
                'KodeRouting' => 71,
                'Site' => 'Cikarang',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'CFM',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '650-15767',
                'KodeRouting' => 71,
                'Site' => 'Bandung1',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'CFM',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '650-15766',
                'KodeRouting' => 72,
                'Site' => 'Bandung1',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
        ];

  //       if($this->request->getGet('order')) {
  //       	$sort = $this->request->getGet('order')['0']['dir'];
  //       	switch ($this->request->getGet('order')['0']['column']) {
  //               case 1:
  //                   $column = 'SPMBNo';
  //                   break;
  //                case 2:
  //                   $column = 'Site';
  //                   break;
  //               case 3:
  //                   $column = 'Step1';
  //                   break;
  //               case 4:
  //                   $column = 'Step2';
  //                   break;
  //               case 5:
  //                   $column = 'Step3';
  //                   break;
  //               case 6:
  //                   $column = 'Step4';
  //                   break;
  //               case 7:
  //                   $column = 'Step5';
  //                   break;
  //               case 8:
  //                   $column = 'Step6';
  //                   break;
  //               case 9:
  //                   $column = 'Step7';
  //                   break;
  //               default:
  //                   $column = 'SPMBNo';
  //           }
  //           usort($source, function($a, $b) use ($sort, $column) {
  //           	if($sort == 'desc') {
  //           		return $b[$column] <=> $a[$column];
  //           	} else {
  //           		return $a[$column] <=> $b[$column];
  //           	}
	 //        });
  //       }

  //       $data = array_slice($source, $offset, $limit);

		// $response = [
  //           'draw' => ($this->request->getGet('draw') != null) ? $this->request->getGet('draw') : 0,
  //           'recordsTotal' => count($data),
  //           'recordsFiltered' => count($source),
  //           'datadraw' => $this->request->getGet('draw'),
  //           'limit' => $limit,
  //           'offset' => $offset,
  //           'data' => $data,
  //       ];
        
        $newdata = [];
        foreach ($source as $key => $val) {
            $newdata[] = [
                $key + 1,
                $val['SPMBNo'],
                $val['Site'],
                ($val['Step1'] != null) ? $val['Step1'] : '',
                ($val['Step2'] != null) ? $val['Step2'] : '',
                ($val['Step3'] != null) ? $val['Step3'] : '',
                ($val['Step4'] != null) ? $val['Step4'] : '',
                ($val['Step5'] != null) ? $val['Step5'] : '',
                ($val['Step6'] != null) ? $val['Step6'] : '',
                ($val['Step7'] != null) ? $val['Step7'] : '',
            ];
        }

        $response = $newdata;

        return $this->response->setJSON($response);
	}

    public function params()
    {

        $source = [
            [
                'SPMBNo' => '10001',
                'KodeRouting' => 72,
                'Site' => 'Cikarang',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Step8' => null,
                'Step9' => null,
                'Step10' => null,
                'Step11' => null,
                'ACC1' => null,
                'ACC2' => null,
                'ACC3' => null,
                'ACC4' => null,
                'ACC5' => null,
                'ACC6' => null,
                'ACC7' => null,
                'ACC8' => null,
                'ACC9' => null,
                'ACC10' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '10002',
                'KodeRouting' => 72,
                'Site' => 'Cikarang',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '10003',
                'KodeRouting' => 72,
                'Site' => 'Cikarang',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '10004',
                'KodeRouting' => 71,
                'Site' => 'Surabaya',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'CFM',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '10005',
                'KodeRouting' => 72,
                'Site' => 'Surabaya',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '10006',
                'KodeRouting' => 72,
                'Site' => 'Surabaya',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '10007',
                'KodeRouting' => 72,
                'Site' => 'Surabaya',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '10008',
                'KodeRouting' => 71,
                'Site' => 'Cikarang',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'CFM',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '10009',
                'KodeRouting' => 71,
                'Site' => 'Cikarang',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'CFM',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '10009',
                'KodeRouting' => 71,
                'Site' => 'Bandung1',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '10010',
                'KodeRouting' => 71,
                'Site' => 'Cikarang',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'CFM',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '10011',
                'KodeRouting' => 71,
                'Site' => 'Bandung1',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'CFM',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
            [
                'SPMBNo' => '10012',
                'KodeRouting' => 72,
                'Site' => 'Bandung1',
                'Step1' => 'Logistic',
                'Step2' => 'Manager Peminta',
                'Step3' => 'GM Peminta',
                'Step4' => 'Pembeli',
                'Step5' => null,
                'Step6' => null,
                'Step7' => null,
                'Tolak' => null,
                'Batal' => null,
                'Complete' => null,
                'InsertDate' => '2020-01-11 08:52:00',
            ],
        ];
        
        $newdata = [];
        foreach ($source as $key => $val) {
            $newdata[] = [
                $key + 1,
                $val['SPMBNo'],
                $val['Site'],
                ($val['Step1'] != null) ? $val['Step1'] : '',
                ($val['Step2'] != null) ? $val['Step2'] : '',
                ($val['Step3'] != null) ? $val['Step3'] : '',
                ($val['Step4'] != null) ? $val['Step4'] : '',
                ($val['Step5'] != null) ? $val['Step5'] : '',
                ($val['Step6'] != null) ? $val['Step6'] : '',
                ($val['Step7'] != null) ? $val['Step7'] : '',
            ];
        }

        $response = $newdata;

        return $this->response->setJSON($response);
    }
}