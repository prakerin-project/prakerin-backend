<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Monitoring
 *
 * @property string $id
 * @property string $nip_pembimbing
 * @property string $id_prakerin
 * @property string $tanggal
 * @property string $catatan
 * @property string $bukti
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pembimbing $pembimbing
 * @property-read \App\Models\Prakerin $prakerin
 * @method static \Illuminate\Database\Eloquent\Builder|Monitoring newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monitoring newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monitoring query()
 * @method static \Illuminate\Database\Eloquent\Builder|Monitoring whereBukti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitoring whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitoring whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitoring whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitoring whereIdPrakerin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitoring whereNipPembimbing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitoring whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monitoring whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Monitoring extends Model
{
    use HasFactory;

    protected $table = 'monitoring';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = ['id'];
    public $timestamps = true;
    /* -------------------------------- RELATION -------------------------------- */
    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, 'nip_pembimbing');
    }
    public function prakerin()
    {
        return $this->belongsTo(Prakerin::class, 'id_prakerin');
    }
}