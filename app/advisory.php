<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class advisory extends Model
{
    protected $fillable = [
      'user_id','teacherName', 'className', 'subjectName'
    ];
}
