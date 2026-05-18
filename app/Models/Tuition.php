<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuition extends Model
{
    use HasFactory;
    protected $fillable = [
        'semester',
        'child_id',
        'status'
    ];
    function child(){
        return $this->belongsTo(Child::class,'child_id');
    }
    function tuition_info(){
        return $this->hasMany(Tuition_Info::class,'tuition_id');
    }
public function classroom()
{
    return $this->belongsTo(Classroom::class);
}

}
