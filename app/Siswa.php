<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'user_id','nama', 'avatar','nipd', 'jeniskelamin','nisn','tempatlahir','tanggallahir','agama','email','kelas_id',
    ];

    public function getAvatar(){
        if(!$this->avatar){
            return asset('assets/img/undraw_profile.svg');
        }
        return asset('images/'.$this->avatar);
    }

    public function user(){
        return $this->belongsTo('\App\User');
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }


}
