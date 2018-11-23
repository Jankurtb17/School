<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class yearlevels extends Model
{
    protected $table = 'yearlevels';

    protected $fillable = [
      'yearLevel', 'description'
    ];
}
