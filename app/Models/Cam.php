<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cam extends Model
{
     protected $fillable = [
        'name',
        'stream_url'
    ];
}
