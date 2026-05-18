<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'classroom_id'
    ];
    function classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }
    function schedule_info(){
        return $this->hasMany(Schedule_Info::class,'schedule_id');
    }
}
