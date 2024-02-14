<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Prakerin
 *
 * @property string $id
 * @property string $id_pengajuan
 * @property string $nis_siswa
 * @property string $nip_pembimbing_sekolah
 * @property string $nik_pembimbing_industri
 * @property string $status
 * @property string $tanggal_mulai
 * @property string $tanggal_selesai
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AktivitasJurnal> $aktivitas_jurnal
 * @property-read int|null $aktivitas_jurnal_count
 * @property-read \App\Models\Pembimbing $pembimbing_indsutri
 * @property-read \App\Models\Pembimbing $pembimbing_sekolah
 * @property-read \App\Models\Pengajuan $pengajuan
 * @property-read \App\Models\Siswa $siswa
 * @method static \Illuminate\Database\Eloquent\Builder|Prakerin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prakerin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prakerin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Prakerin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prakerin whereIdPengajuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prakerin whereNikPembimbingIndustri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prakerin whereNipPembimbingSekolah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prakerin whereNisSiswa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prakerin whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prakerin whereTanggalMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prakerin whereTanggalSelesai($value)
 * @mixin \Eloquent
 */
class Prakerin extends Model
{
    use HasFactory;

    protected $table = 'prakerin';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = ['id'];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function aktivitas_jurnal()
    {
        return $this->hasMany(AktivitasJurnal::class,'id_prakerin');
    }
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class,'id_pengajuan');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class,'nis_siswa');
    }
    public function pembimbing_sekolah()
    {
        return $this->belongsTo(Pembimbing::class,'nip_pembimbing_sekolah');
    }
    public function pembimbing_indsutri()
    {
        return $this->belongsTo(Pembimbing::class,'nik_pembimbing_industri');
    }
}
