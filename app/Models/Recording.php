<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recording extends Model
{
    use HasFactory;
    /*
     
            $table->id();
            $table->string('recording_id');
            $table->string('meeting_id');
            $table->string('instance_uuid');
            $table->string('file_type');
            $table->integer('file_size');
            $table->string('play_url')->nullable();
            $table->string('download_url')->nullable();
            $table->string('status');
            $table->string('recording_type');
            $table->timestamps();
    */
     protected $table='recordings';
     protected $fillable=['recording_id','meeting_id','instance_uuid','file_type','file_size','play_url','download_url','status','recording_type'];

     public function meeting()
     {
         return $this->belongsTo(Meeting::class,'meeting_id');
     }

     public function instance()
     {
         return $this->belongsTo(Instance::class,'instance_uuid');
     }


}
