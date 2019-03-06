<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sendgradeadmin extends Model
{
  use SoftDeletes;

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

  protected $softDelete = true;
}
  