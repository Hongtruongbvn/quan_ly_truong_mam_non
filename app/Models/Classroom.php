<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'user_id',
        'status',
    ];
    function user(){
        return $this->belongsTo(User::class,'user_id');
    }
     function facilities(){
        return $this->hasMany(Facilities::class,'classroom_id');
    }
    function schedule(){
        return $this->hasMany(Schedule::class,'classroom_id');
    }
    public function children()
{
    return $this->belongsToMany(Child::class, 'childclasses', 'classroom_id', 'child_id');
}

}
