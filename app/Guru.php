<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Guru extends Model
{
    protected $fillable=[
        'user_id',
        'mapel_id',
        'nama',
        'nip',
        'nik',
        'jeniskelamin',
        'tanggallahir',
        'tempatlahir',
        'agama',
        'no_hp',
        'jabatan',
        'jurusan',
        'avatar',
        'email',
    ];

    public function user(){
        return $this->belongsTo('\App\User');
    }

    /**
     * Karena guru bakal punya mapel jadi saya has many aja
     * soalnya biar gak ribet pas olah ada foreach di controller
     * karena foreach butuh array kalau bukan array entar error
     *
     */
    public function mapels(){
        return $this->hasMany(Mapel::class,'id','mapel_id');
    }

    public function getAvatar(){
        if(!$this->avatar){
            return asset('assets/img/undraw_profile.svg');
        }
        return asset('images/'.$this->avatar);
    }
}
