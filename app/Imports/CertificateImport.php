<?php

namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Certificate;
class CertificateImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new Certificate([
           'name'     => $row[0],
           'course'    => $row[1], 
           'certificate_id' => $row[2],
           'place' => $row[3],
           'date' => $row[4],
           'certificate_model_num' => $row[5],
        ]);
    }
}