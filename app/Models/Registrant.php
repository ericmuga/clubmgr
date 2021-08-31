<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registrant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='registrants';

/*
 $table->integer('meeting_id')
                  ->foreign()
                  ->references('id')
                  ->on('meetings')
                  ->onDelete('cascade');
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('category');
            $table->string('club_name');
            $table->string('invited_by');
            $table->string('classification');
            $table->dateTimeTz('create_time');
            $table->softDeletes();
            $table->timestamps();

*/


    protected $fillable=[
                  'meeting_id',
                  'emai',
                  'first_name',
                  'last_name',
                  'category',
                  'club_name',
                  'invited_by',
                  'classification',
                  'create_time'
       ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
    
}
