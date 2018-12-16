<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class advisory extends Model
{
    protected $fillable = [
      'teacherName', 'className', 'subjectName'
    ];
}
