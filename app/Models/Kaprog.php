<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprog extends Model
{
    use HasFactory;

    protected $table = 'kaprog';
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    protected $guarded = ['nip'];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class,'id_jurusan');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class,'nip_kaprog');
    }
}
