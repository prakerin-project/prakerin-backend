<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Perusahaan
 *
 * @property int $id
 * @property int $id_jenis_perusahaan
 * @property string $nama_perusahaan
 * @property string $email
 * @property string $alamat
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Foto> $foto
 * @property-read int|null $foto_count
 * @property-read \App\Models\JenisPerusahaan $jenis_perusahaan
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan whereIdJenisPerusahaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan whereNamaPerusahaan($value)
 * @mixin \Eloquent
 */
class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = ['id'];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function jenis_perusahaan()
    {
        return $this->belongsTo(JenisPerusahaan::class, 'id_jenis_perusahaan');
    }

    public function foto()
    {
        return $this->hasMany(Foto::class, 'id_perusahaan');
    }
}
