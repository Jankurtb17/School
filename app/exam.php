<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class exam extends Model
{
    protected $fillable = [
      'schoolYear', 'examDate'
    ];
}
