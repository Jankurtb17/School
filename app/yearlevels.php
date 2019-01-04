<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class yearlevels extends Model
{
    use Sortable; 
    
    protected $table = 'yearlevels';

    protected $fillable = [
      'yearLevel', 'description'
    ];

    protected $sortable =  [
      'id', 'yearLevel', 'description'
    ];
}
