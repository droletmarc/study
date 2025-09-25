<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
//use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject; # to use JWT auth
//use Laravel\Passport\HasApiTokens; #to use passport auth

//class User extends Authenticatable implements MustVerifyEmail, JWTSubject # to use JWT auth
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    // use HasApiTokens; # to use passport auth

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    // To use JWT auth
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    // to use JWT auth
    public function getJWTCustomClaims() {
        return [];
    }
}
