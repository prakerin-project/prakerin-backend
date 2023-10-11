<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    protected $keyType = 'string';
    protected $guarded = ['nis'];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function kelas()
    {
        $this->hasOne(Kelas::class, 'id_kelas');
    }

    public function user()
    {
        $this->belongsTo(User::class, 'id_user');
    }
}
