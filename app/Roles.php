<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Roles extends Model
{
  use Notifiable;

  protected $guard = 'Roles';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'name',
    ];

    public function Users(){
        return $this->hasMany('App\User');
    }
 
}
