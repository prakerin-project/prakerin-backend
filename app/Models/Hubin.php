<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hubin extends Model
{
    use HasFactory;

    protected $table = 'hubin';
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    protected $guarded = [];

    public $timestamps = false;
}
