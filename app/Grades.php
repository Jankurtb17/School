<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
  protected $fillable = [
    'student_id', 
    'gradeLevel', 
    'schoolYear', 
    'gradingperiod', 
    'className', 
    'subjectCode', 
    'firstGrading',  
    'secondGrading',
    'thirdGrading',
    'fourthGrading',
    'employee_id'
  ];

}
