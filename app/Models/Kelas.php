<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Kelas
 *
 * @property int $id
 * @property int $id_jurusan
 * @property string|null $kelompok
 * @property string $tingkat
 * @property int $angkatan
 * @property-read \App\Models\Jurusan $jurusan
 * @property-read \App\Models\Walas|null $walas
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas whereAngkatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas whereIdJurusan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas whereKelompok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelas whereTingkat($value)
 * @mixin \Eloquent
 */
class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = ['id'];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function walas()
    {
        return $this->hasOne(Walas::class, 'id_kelas');
    }
    public function siswa()
    {
        return $this->hasMany(Siswa::class,'id_kelas');
    }
}
