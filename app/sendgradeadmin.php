<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sendgradeadmin extends Model
{
  protected $fillable = [
    'student_id', 
    'gradeLevel', 
    'schoolYear', 
    'gradingperiod', 
    'className', 
    'subjectCode', 
    'grade',  
    'employee_id'
  ];
}
