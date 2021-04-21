<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question', 'description', 'no_thumbs_up', 'no_thumbs_down'];
}
