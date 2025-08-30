<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportExcel implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pegawai::select('id', 'nama', 'alamat', 'kelamin', 'telp', 'foto', 'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Alamat',
            'Kelamin',
            'Telp',
            'foto',
            'Tanggal Buat',
        ];
    }
}
