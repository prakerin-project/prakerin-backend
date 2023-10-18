<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TataUsaha
 *
 * @property string $nip
 * @property string $id_user
 * @property string $nama
 * @property string $no_telp
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TataUsaha newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TataUsaha newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TataUsaha query()
 * @method static \Illuminate\Database\Eloquent\Builder|TataUsaha whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TataUsaha whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TataUsaha whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TataUsaha whereNoTelp($value)
 * @mixin \Eloquent
 */
class TataUsaha extends Model
{
    use HasFactory;

    protected $table = 'tata_usaha';
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}