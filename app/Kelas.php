<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable =[
        'namakelas','walikelas',
    ];

    public function siswa(){
        return $this->hasMany(Siswa::class);
    }
}
