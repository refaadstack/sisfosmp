<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable=[
        'nama','nuptk','mapel_id','jeniskelamin','user_id','avatar','tempatlahir','tanggallahir','agama','email','nip'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function mapels(){
        return $this->belongsTo(Mapel::class);
    }

    public function getAvatar(){
        if(!$this->avatar){
            return asset('assets/img/undraw_profile.svg');
        }
        return asset('images/'.$this->avatar);
    }
}
