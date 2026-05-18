<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dentail_Facilities extends Model
{
    use HasFactory;
        protected $fillable = [
        'name',
        'total_id',
        'quantity'
    ];
    function Total(){
        return $this->belongsTo(Total_Facilities::class,'total_id');
    }
}
