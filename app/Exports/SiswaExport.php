<?php

namespace App\Exports;

use App\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'ID',
            'User id',
            'NAMA',
            'NIS',
            'NISN',
            'ID KELAS',
            'JENIS KELAMIN',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'AGAMA',
            'NAMA ORANG TUA',
            'EMAIL',
            'LOKASI AVATAR',
            'DIBUAT',
            'DIEDIT'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::all();
    }
}
