<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
  use Notifiable;

  protected $guard = 'teacher';

  protected $fillable = [
    'role_id', 'employee_Id', 'firstName', 'lastName', 'email', 'password'
  ];
 
  protected $hidden = [
    'password'
  ];
}
