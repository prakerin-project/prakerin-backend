<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Siswa
 *
 * @property string $nis
 * @property int $id_kelas
 * @property string $id_user
 * @property string $nama
 * @property string $email
 * @property string $tahun_masuk
 * @property string $jenis_kelamin
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $alamat
 * @property string $no_telp
 * @property string $no_telp_wali
 * @property-read \App\Models\Kelas|null $kelas
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereIdKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereNis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereNoTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereNoTelpWali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereTahunMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereTempatLahir($value)
 * @mixin \Eloquent
 */
class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
