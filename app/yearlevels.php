<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class yearlevels extends Model
{
    use Sortable; 
    
    protected $table = 'yearlevels';

    protected $fillable = [
      'schoolYear', 'gradeLevel', 'className'
    ];

    protected $sortable =  [
      'id', 'schoolYear', 'gradeLevel', 'className'
    ];
}
