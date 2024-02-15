<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pengajuan
 *
 * @property string $id
 * @property string $nip_walas
 * @property string $nip_kaprog
 * @property string $tanggal_pengajuan
 * @property string $nama_industri
 * @property string $alamat
 * @property string $kontak_industri
 * @property string|null $persetujuan_walas
 * @property string|null $persetujuan_kaprog
 * @property string|null $persetujuan_tu
 * @property string|null $surat_resmi
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kaprog $kaprog
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Prakerin> $prakerin
 * @property-read int|null $prakerin_count
 * @property-read \App\Models\Walas $walas
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan whereKontakIndustri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan whereNamaIndustri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan whereNipKaprog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan whereNipWalas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan wherePersetujuanKaprog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan wherePersetujuanTu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan wherePersetujuanWalas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan whereSuratResmi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan whereTanggalPengajuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengajuan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [''];
    public $timestamps = true;
    /* -------------------------------- RELATION -------------------------------- */
    public function walas()
    {
        return $this->belongsTo(Walas::class, 'nip_walas');
    }
    public function kaprog()
    {
        return $this->belongsTo(Kaprog::class, 'nip_kaprog');
    }
    public function prakerin()
    {
        return $this->hasMany(Prakerin::class, 'id_pengajuan');
    }
}