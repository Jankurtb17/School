<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = [
      'subjectName', 'description', 'yearLevel'
    ];
}
