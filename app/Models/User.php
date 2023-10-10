<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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