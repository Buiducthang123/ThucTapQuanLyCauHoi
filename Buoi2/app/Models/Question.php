<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['Content','OptionA','OptionB','OptionC','OptionD','CorrectOption'];

    function tests() {
        return $this->belongsToMany(Test::class,'test_questions','question_id','test_id')->withTimestamps();
    }
}
