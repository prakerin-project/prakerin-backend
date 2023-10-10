<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TataUsaha extends Model
{
    use HasFactory;

    protected $table = 'tata_usaha';
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    protected $guarded = ['nip'];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}