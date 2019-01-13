<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class advisory extends Model
{
    protected $fillable = [
      'user_id',
      'gradeLevel',
      'className', 
      'employee_id',
    ];
}
