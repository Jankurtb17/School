<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nameOfClasses extends Model
{
    protected $table  ="name_of_classes";

    protected $fillable = [
      'className', 'schoolYear', 'yearLevel'
    ];
}
