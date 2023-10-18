<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Hubin
 *
 * @property string $nip
 * @property string $id_user
 * @property string $nama
 * @property string $no_telp
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Hubin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hubin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hubin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hubin whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hubin whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hubin whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hubin whereNoTelp($value)
 * @mixin \Eloquent
 */
class Hubin extends Model
{
    use HasFactory;

    protected $table = 'hubin';
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }
}
