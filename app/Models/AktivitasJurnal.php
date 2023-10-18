<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AktivitasJurnal
 *
 * @property int $id
 * @property string $id_prakerin
 * @property \App\Models\Pembimbing|null $pengonfirmasi
 * @property string $aktivitas
 * @property string $tanggal
 * @property string $konfirmasi
 * @property string $foto
 * @property string $jam_masuk
 * @property string $jam_pulang
 * @property-read \App\Models\Prakerin $prakerin
 * @method static \Illuminate\Database\Eloquent\Builder|AktivitasJurnal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AktivitasJurnal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AktivitasJurnal query()
 * @method static \Illuminate\Database\Eloquent\Builder|AktivitasJurnal whereAktivitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AktivitasJurnal whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AktivitasJurnal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AktivitasJurnal whereIdPrakerin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AktivitasJurnal whereJamMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AktivitasJurnal whereJamPulang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AktivitasJurnal whereKonfirmasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AktivitasJurnal wherePengonfirmasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AktivitasJurnal whereTanggal($value)
 * @mixin \Eloquent
 */
class AktivitasJurnal extends Model
{
    use HasFactory;

    protected $table = 'aktivitas_jurnal';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = ['id'];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function prakerin()
    {
        return $this->belongsTo(Prakerin::class, 'id_prakerin');
    }
    public function pengonfirmasi()
    {
        return $this->belongsTo(Pembimbing::class, 'pengonfirmasi');
    }
}
