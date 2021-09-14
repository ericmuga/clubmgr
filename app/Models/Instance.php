<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    use HasFactory;
    protected $fillable=['uuid','meeting_id','start_time'];
    protected $dates=['start_time','created_at','updated_at'];
    protected $table ='instances';

    public function meeting()
    {
        return $this->belongsTo(Meeting::class,'meeting_id');
    }
}
