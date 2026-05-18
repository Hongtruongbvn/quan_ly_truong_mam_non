<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule_Info extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'schedule_id',
        'subject_id'
    ];
    function schedule(){
        return $this->belongsTo(Schedule::class,'schedule_id');
    }
    function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }

}
