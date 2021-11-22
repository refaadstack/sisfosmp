<?php

namespace App\Exports;

use App\Guru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {

        return [
            'ID',
            'User id',
            'MAPEL id',
            'NAMA',
            'NIP',
            'JENIS KELAMIN',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'AGAMA',
            'NO HP',
            'JURUSAN',
            'JABATAN',
            'LOKASI AVATAR',
            'EMAIL',
            'DIBUAT',
            'DIEDIT'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Guru::all();
    }
}
