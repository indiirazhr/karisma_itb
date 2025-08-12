<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'no_wa',
        'foto',
        'nama_univ',
        'thn_masuk',
        'kelas',
        'asal_sekolah',
        'role_id',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function rapors()
    {
        return $this->hasMany(Raport::class);
    }

    //  public function amalyaumi()
    // {
    //     return $this->hasMany(AmalYaumi::class);
    // }

    // public function pembayaran()
    // {
    //     return $this->hasMany(Pembayaran::class);
    // }

    //  public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }


}
