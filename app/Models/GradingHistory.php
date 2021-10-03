<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingHistory extends Model
{
    use HasFactory;

    /*
     
            $table->id();
            $table->string('UserID');
            $table->dateTime('From');
            $table->dateTime('To');
            $table->string('Meeting_ID');
            $table->string('Category');
            $table->string('Rule');
    
    */
    protected $table='grading_histories';
    protected $fillable=['user_id','from','to','meeting_id','category','grading_rule_id'];

    public function grading_rule()
    {
        return $this->belongsTo(GradingRule::class,'grading_rule_id','id');
    }
}
