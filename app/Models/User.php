<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'gender',
        'birth_of_date',
        'religion',
        'class',
        'section',
        'student_id',
        'address',
        'phone',
        'subject',
        'designation',
        'qualification',
        'university',
        'problem_request_id',


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function problem_requests(){
    //     return  $this->hasmany(Problem_request::class);
    // }


public function problem_request()
{
  return $this->hasMany(Problem_request::class);
}

public function problem_requests()
    {
        return $this->belongsToMany(Problem_request::class,'problem_request_user');
    }

}
