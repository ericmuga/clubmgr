<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    use HasFactory;
    protected $fillable=['uuid','meeting_id','start_time','official_start_time','official_end_time'];
    protected $dates=['start_time','created_at','updated_at','official_start_time','official_end_time'];
    protected $table ='instances';

    public function meeting()
    {
        return $this->belongsTo(Meeting::class,'meeting_id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class,'instance_uuid','uuid');
    }
}
