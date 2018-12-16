<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class manageclass extends Model
{
    protected $fillable = [
      'class', 'student', 'subject'
    ];
}
