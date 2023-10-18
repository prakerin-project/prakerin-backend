<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property string $id
 * @property string $username
 * @property mixed $password
 * @property string $role
 * @property string|null $foto_profil
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Hubin|null $hubin
 * @property-read \App\Models\Kaprog|null $kaprog
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Pembimbing|null $pembimbing
 * @property-read \App\Models\Siswa|null $siswa
 * @property-read \App\Models\TataUsaha|null $tata_usaha
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\Walas|null $walas
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFotoProfil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasUuids;

    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $keyType = 'uuid';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
    /* -------------------------------- RELATION -------------------------------- */
    public function hubin()
    {
        return $this->hasOne(Hubin::class, 'id_user');
    }
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id_user');
    }
    public function tata_usaha()
    {
        return $this->hasOne(TataUsaha::class, 'id_user');
    }
    public function walas()
    {
        return $this->hasOne(Walas::class, 'id_user');
    }
    public function pembimbing()
    {
        return $this->hasOne(Pembimbing::class, 'id_user');
    }
    public function kaprog()
    {
        return $this->hasOne(Kaprog::class, 'id_user');
    }
}