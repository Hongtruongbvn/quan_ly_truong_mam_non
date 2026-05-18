<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Total_Facilities extends Model
{
    use HasFactory;
      protected $fillable = [
        'name'
    ];
    function dentail(){
        return $this->hasMany(Dentail_Facilities::class,'total_id');
    }
}
