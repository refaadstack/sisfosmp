<?php

namespace App\Imports;

use App\Siswa;
use App\User;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

           

               $user = new User;
               $user->name = $row[1];
               $user->email = $row[8];
               $user->role = 'siswa';
               $user->password = bcrypt('12345678');
               $user->remember_token = str::random(60);
               $user->save();
            
            
            Siswa::create([
                'user_id'       => $user->id,
                'nama'          => $row[1],
                'nis'           => $row[2],
                'jeniskelamin'  => $row[3],
                'nisn'          => $row[4],
                'tempatlahir'   => $row[5],
                'tanggallahir'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]),
                'agama'         => $row[7],
                'email'         => $row[8],
                'kelas_id'      => $row[9],
                'nama_orangtua' => $row[10],
            ]);
        }
    }
