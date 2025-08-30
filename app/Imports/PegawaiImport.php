<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;

class PegawaiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pegawai([
           'nama' => $row[1],
           'alamat' => $row[2],
           'kelamin' => $row[3],
           'telp' => $row[4],
           'foto' => $row[5]
        ]);
    }
}
