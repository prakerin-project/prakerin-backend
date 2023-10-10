<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $table = 'monitoring';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = ['id'];
    public $timestamps = true;
    /* -------------------------------- RELATION -------------------------------- */
    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, 'nip_pembimbing');
    }
    public function prakerin()
    {
        return $this->belongsTo(Prakerin::class, 'id_prakerin');
    }
}