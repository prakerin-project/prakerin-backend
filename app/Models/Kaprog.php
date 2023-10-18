<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Kaprog
 *
 * @property string $nip
 * @property int $id_jurusan
 * @property int $id_user
 * @property string $nama
 * @property string $no_telp
 * @property-read \App\Models\Jurusan $jurusan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pengajuan> $pengajuan
 * @property-read int|null $pengajuan_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Kaprog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kaprog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kaprog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kaprog whereIdJurusan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kaprog whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kaprog whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kaprog whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kaprog whereNoTelp($value)
 * @mixin \Eloquent
 */
class Kaprog extends Model
{
    use HasFactory;

    protected $table = 'kaprog';
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class,'id_jurusan');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class,'nip_kaprog');
    }
}
