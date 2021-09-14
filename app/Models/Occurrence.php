<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occurrence extends Model
{
    use HasFactory;

   protected $table ="occurrences";
   protected $fillable=["meeting_id","occurrence_id","start_time","duration"];
   protected $dates=["start_time","created_at","updated_at"];


   public function meeting()
   {
       return $this->belongsTo(Meeting::class,"meeting_id");
   }

   

}
