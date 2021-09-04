<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Meeting;

class Participant extends Model
{
    use HasFactory;
    use SoftDeletes;
  /*

   $table->string('participant_id');
            $table->string('user_id');
            $table->string('name');
            $table->strin('user_email');
            $table->timestampsTz('join_time');
            $table->timestampsTz('leave_time');
            $table->integer('duration');
            $table->string('registrant_id');
            $table->timestamps();
  */
    protected $table='participants';
    protected $fillable=[ 
                          'meeting_id',
                          'participant_id',
                          'user_id',
                          'name',
                          'user_email',
                          'join_time',
                          'leave_time',
                          'duration',
                          'registrant_id',
                          ];
  protected $dates=[ 'join_time',
                          'leave_time','created_at','updated_at','deleted_at'];

   public function registrant()
  {
      return $this->belongsTo(Registrant::class,'meeting_id','meeting_id');
  }
  public function meeting()
  {
     return $this->belongsTo(Meeting::class,'meeting_id','meeting_id'); 
  }
  
  

  public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('user_email', 'like', '%'.$search.'%')
                    ->orwhere('participant_id', 'like', '%'.$search.'%')
                    ->orwhere('name', 'like', '%'.$search.'%')
                    ->orWhere('meeting_id', 'like', '%'.$search.'%')
                    ->orWhere('join_time', 'like', '%'.$search.'%')
                    ->orWhere('leave_time', 'like', '%'.$search.'%')
                    ->orWhere('name', 'like', '%'.$search.'%');
                    // ->orWhereHas('affiliations', function ($query) use ($search) {
                    //     $query->where('code', 'like', '%'.$search.'%');
                    // })
                    // ->orWhereHas('types', function ($query) use ($search) {
                    //     $query->where('code', 'like', '%'.$search.'%');
                    // });
            });
        
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

}
