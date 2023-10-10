<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prakerin extends Model
{
    use HasFactory;

    protected $table = 'prakerin';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = ['id'];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function aktivitas_jurnal()
    {
        return $this->hasMany(AktivitasJurnal::class,'id_prakerin');
    }
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class,'id_pengajuan');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class,'nis_siswa');
    }
    public function pembimbing_sekolah()
    {
        return $this->belongsTo(Pembimbing::class,'nip_nik_pembimbing_sekolah');
    }
    public function pembimbing_indsutri()
    {
        return $this->belongsTo(Pembimbing::class,'nip_nik_pembimbing_industri');
    }
}
