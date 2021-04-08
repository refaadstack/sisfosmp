<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{

  protected $fillable=['hari','kelas_id','mapel_id','guru_id','jam_mulai','jam_selesai'];

    public function kelas()
  {
    return $this->belongsTo('App\Kelas')->withDefault();
  }

  public function mapel()
  {
    return $this->belongsTo('App\Mapel')->withDefault();
  }

  public function guru()
  {
    return $this->belongsTo('App\Guru')->withDefault();
  }
}
