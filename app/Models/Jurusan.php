<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Jurusan
 *
 * @property int $id
 * @property string $nama_jurusan
 * @property string $akronim
 * @property-read \App\Models\Kaprog|null $kaprog
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Kelas> $kelas
 * @property-read int|null $kelas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pembimbing> $pembimbing
 * @property-read int|null $pembimbing_count
 * @method static \Illuminate\Database\Eloquent\Builder|Jurusan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jurusan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jurusan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Jurusan whereAkronim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jurusan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jurusan whereNamaJurusan($value)
 * @mixin \Eloquent
 */
class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = ['id'];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_jurusan');
    }
    public function pembimbing()
    {
        return $this->hasMany(Pembimbing::class, 'id_jurusan');
    }
    public function kaprog()
    {
        return $this->hasOne(Kaprog::class, 'id_jurursan');
    }
}