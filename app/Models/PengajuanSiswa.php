<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PengajuanSiswa
 *
 * @property int $id
 * @property string $id_pengajuan
 * @property string $nis_siswa
 * @property-read \App\Models\Pengajuan $pengajuan
 * @property-read \App\Models\Siswa $siswa
 * @method static \Illuminate\Database\Eloquent\Builder|PengajuanSiswa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PengajuanSiswa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PengajuanSiswa query()
 * @method static \Illuminate\Database\Eloquent\Builder|PengajuanSiswa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengajuanSiswa whereIdPengajuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengajuanSiswa whereNisSiswa($value)
 * @mixin \Eloquent
 */
class PengajuanSiswa extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_siswa';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = ['id'];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis_siswa');
    }
}