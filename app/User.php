<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends BaseModel
{
  use HasApiTokens, Notifiable;

  protected $table = 'users';
  protected $primaryKey = 'id';
  protected $keyType = 'string';
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name', 'email', 'password', 'role',
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = Hash::make($value);
  }

  public function generateAccessToken()
  {
    return $this->createToken('Passport Access Token')->accessToken;
  }

  public function isAdmin()
  {
    return $this->role == 'Admin' ? true : false;
  }

  public function isUser()
  {
    return $this->role == 'User' ? true : false;
  }

  public function isGuest()
  {
    return $this->role == 'Guest' ? true : false;
  }
}
