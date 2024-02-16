<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Walas
 *
 * @property string $nip
 * @property int $id_kelas
 * @property string $id_user
 * @property string $nama
 * @property string $no_telp
 * @property string $jenis_kelamin
 * @property-read \App\Models\Kelas $kelas
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Walas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Walas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Walas query()
 * @method static \Illuminate\Database\Eloquent\Builder|Walas whereIdKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Walas whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Walas whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Walas whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Walas whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Walas whereNoTelp($value)
 * @mixin \Eloquent
 */
class Walas extends Model
{
    use HasFactory;

    protected $table = 'walas';
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kelas()
    {
        return $this->hasOne(Walas::class, 'nip', 'wali_kelas');
    }
}
