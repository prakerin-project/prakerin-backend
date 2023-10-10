<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walas extends Model
{
    use HasFactory;

    protected $table = 'walas';
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    protected $guarded = [];

    public $timestamps = false;
}
