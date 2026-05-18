<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'classroom_id',
        'quantity',
        'dentail_id'
    ];
    function classrooms(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }
    function dentail()
    {
        return $this->belongsTo(Dentail_Facilities::class, 'dentail_id');
    }
}
