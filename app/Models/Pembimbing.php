<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    use HasFactory;

    protected $table = 'pembimbing';
    protected $primaryKey = 'nip_nik';
    protected $keyType = 'string';
    protected $guarded = ['nip_nik'];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function aktivitas_jurnal()
    {
        return $this->hasMany(AktivitasJurnal::class, 'pengonfirmasi', 'nip_nik');
    }

    public function monitoring()
    {
        return $this->hasMany(Monitoring::class, 'nip_pembimbing');
    }
}
