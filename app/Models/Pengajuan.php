<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = ['id'];
    public $timestamps = true;
    /* -------------------------------- RELATION -------------------------------- */
    public function walas()
    {
        return $this->belongsTo(Walas::class, 'nip_walas');
    }
    public function kaprog()
    {
        return $this->belongsTo(Kaprog::class, 'nip_kaprog');
    }
    public function prakerin()
    {
        return $this->hasMany(Prakerin::class, 'id_pengajuan');
    }
}