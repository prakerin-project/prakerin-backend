<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = ['id'];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_jurusan');
    }
    public function pembimbing()
    {
        return $this->hasMany(Pembimbing::class, 'id_jurusan');
    }
    public function kaprog()
    {
        return $this->hasOne(Kaprog::class, 'id_jurursan');
    }
}