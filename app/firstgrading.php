<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class firstgrading extends Model
{
    protected $fillable = [
      'student_id', 'gradeLevel', 'schoolYear', 'gradingperiod', 'className', 'subjectCode', 'grade', 'employee_id'
    ];
}
