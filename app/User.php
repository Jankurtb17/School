<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Roles;

class User extends Authenticatable
{
    use Notifiable;

    protected $guard = 'User';

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type','role_id', 'employee_id', 'student_id', 'gradeLevel','className', 'firstName', 'middleName',  'lastName', 'gender',  'email', 'password', 'phone_number', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function routeNotificationForNexmo($notification)
    {
        return $this->contactNumber;
    }
    
}
