<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Instance extends Model
{
    use HasFactory;
    protected $fillable=['uuid','meeting_id','start_time','official_start_time','official_end_time','grading_rule_id'];
    protected $dates=['start_time','created_at','updated_at','official_start_time','official_end_time'];
    protected $table ='instances';
    protected $hidden=['id'];
    
    /*

      this method will return an array of members who attended and instance.

    */
    
    public function scopeGradable($query)
    {
        return $query->where('marked_for_grading',true);
    }
   

    public function meeting()
    {
        return $this->belongsTo(Meeting::class,'meeting_id','meeting_id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class,'instance_uuid','uuid');

    }

    public function grading_rule()
    {
      return $this->belongsTo(GradingRule::class,'grading_rule_id');   
    }
    
    public function recordings()
    {
        return $this->hasMany(Recoding::class,'instance_uuid','uuid');
    }

}
