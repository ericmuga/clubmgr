<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLine extends Model
{
    /*
       $table->foreignId('makeup_event_id');
            $table->string('event_type');
            $table->string('event_description');
            $table->string('event_date');
            $table->string('status')->default('Pending Approval');
            $table->boolean('comment');
    */


    use HasFactory;

    protected $fillable=['makeup_event_id','event_type','event_description','event_date','status','comment'];

    protected $dates=['created_at','updated_at','event_date'];
}
