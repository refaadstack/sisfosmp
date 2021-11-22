<?php

namespace App\Imports;

use App\Guru;
use App\User;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class GuruImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = new User();
        $user->name = $row[2];
        $user->email = $row[11];
        $user->role = 'guru';
        $user->password = bcrypt('rahasia');
        $user->remember_token = str::random(60);
        $user->save();
     
     
     Guru::create([
         'user_id'       => $user->id,
         'mapel_id'      => $row[1],
         'nama'          => $row[2],
         'nip'           => $row[3],
         'jeniskelamin'  => $row[4],
         'tanggallahir'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]),
         'tempatlahir'   => $row[6],
         'agama'         => $row[7],
         'no_hp'         => $row[8],
         'jabatan'       => $row[9],
         'jurusan'       => $row[10],
         'email'         => $row[11],
     ]);
    }
}
