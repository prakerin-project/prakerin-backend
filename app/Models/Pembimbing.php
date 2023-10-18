<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pembimbing
 *
 * @property string $nip_nik
 * @property int $id_jurusan
 * @property string $id_user
 * @property string $nama
 * @property string $no_telp
 * @property string $email
 * @property string $lingkup
 * @property string $jenis_kelamin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AktivitasJurnal> $aktivitas_jurnal
 * @property-read int|null $aktivitas_jurnal_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Monitoring> $monitoring
 * @property-read int|null $monitoring_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Pembimbing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembimbing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembimbing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembimbing whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembimbing whereIdJurusan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembimbing whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembimbing whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembimbing whereLingkup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembimbing whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembimbing whereNipNik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembimbing whereNoTelp($value)
 * @mixin \Eloquent
 */
class Pembimbing extends Model
{
    use HasFactory;

    protected $table = 'pembimbing';
    protected $primaryKey = 'nip_nik';
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function aktivitas_jurnal()
    {
        return $this->hasMany(AktivitasJurnal::class, 'pengonfirmasi', 'nip_nik');
    }

    public function monitoring()
    {
        return $this->hasMany(Monitoring::class, 'nip_pembimbing');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }
}