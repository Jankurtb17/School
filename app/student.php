<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class student extends Authenticatable
{
  use Notifiable;

  protected $guard = 'student';

  protected $fillable = [
      'studentNumber',
      'level',
      'firstName',
      'lastName',
      'contactNumber',
      'email',
      'password',
     
  ];

  protected $hidden = [
    'password', "remember_token"
  ];
}
