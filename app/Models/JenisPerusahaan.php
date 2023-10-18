<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\JenisPerusahaan
 *
 * @property int $id
 * @property string $nama
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Perusahaan> $perusahaan
 * @property-read int|null $perusahaan_count
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerusahaan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerusahaan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerusahaan query()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerusahaan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPerusahaan whereNama($value)
 * @mixin \Eloquent
 */
class JenisPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'jenis_perusahaan';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = ['id'];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function perusahaan()
    {
        return $this->hasMany(Perusahaan::class,'id_jenis_perusahaan');
    }
}
