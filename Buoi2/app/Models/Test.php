<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    function questions(){
        return $this->belongsToMany(Question::class,'test_questions','test_id','question_id')->withPivot('index')->withTimestamps();
    }

    function users()
    {
        return $this->belongsToMany(User::class,'results','user_id','test_id')->withPivot([['test_id','user_id','time_start','time_end','score','status','answers']]);
    }
}
