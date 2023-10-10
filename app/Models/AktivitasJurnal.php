<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasJurnal extends Model
{
    use HasFactory;

    protected $table = 'aktivitas_jurnal';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = ['id'];
    public $timestamps = false;

    /* -------------------------------- RELATION -------------------------------- */
    public function prakerin()
    {
        return $this->belongsTo(Prakerin::class, 'id_prakerin');
    }
    public function pengonfirmasi()
    {
        return $this->belongsTo(Pembimbing::class, 'pengonfirmasi');
    }
}