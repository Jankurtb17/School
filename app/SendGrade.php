<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendGrade extends Model
{
    protected $table ='SemdGrade';

    protected $fillable = [
      'student_id', 'grade', 'phone_number'
    ];
}
