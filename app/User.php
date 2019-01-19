<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Roles;

class User extends Authenticatable
{
    use Notifiable;

    protected $guard = 'User';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type','role_id', 'employee_id', 'student_id', 'gradeLevel','className', 'firstName', 'middleName',  'lastName',  'email', 'password', 'contactNumber'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
