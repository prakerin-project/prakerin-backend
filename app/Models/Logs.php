<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Logs
 *
 * @property int $id
 * @property string $action
 * @property string $activity
 * @property string $user
 * @property string $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|Logs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Logs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Logs query()
 * @method static \Illuminate\Database\Eloquent\Builder|Logs whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logs whereActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logs whereUser($value)
 * @property string $ip_address
 * @method static \Illuminate\Database\Eloquent\Builder|Logs whereIpAddress($value)
 * @mixin \Eloquent
 */
class Logs extends Model
{
    use HasFactory;

    protected $table = 'logs';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = ['id'];
    public $timestamps = false;
}
