<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Meeting;
use App\Models\Instance;
use Carbon\Carbon;

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
                          'instance_uuid',
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
      return $this->belongsTo(Registrant::class,'user_email','email');
  }
  public function meeting()
  {
     return $this->belongsTo(Meeting::class,'meeting_id','meeting_id'); 
  }

  public function instance()
  {
      return $this->belongsTo(Instance::class,'instance_uuid','uuid');
  }



  public function timeCredit()
  {
     $timeToTrim=0;
     $instance= Instance::firstWhere('uuid',$this->instance_uuid);
      if (($instance->official_start_time==null)||
         ($instance->official_end_time==null)||
         ($this->join_time==null)||
         ($this->leave_time==null))
        return 0;

     $startTime=null; $endTime=null;
      if ($instance->official_start_time>$this->join_time)
      {
          $startTime=$instance->official_start_time;
          //$timeToTrim=Carbon::parse($this->join_time)->diffInMinutes($instance->official_start_time);
      }
      else $startTime=$this->join_time;

      if ($instance->official_end_time<$this->leave_time)
      {
        // $timeToTrim+=Carbon::parse($instance->official_end_time)->diffInMinutes($this->join_time);
        $endTime=$instance->official_end_time;
      }
      else $endTime=$this->leave_time;

       if ($this->join_time>$instance->official_end_time) return 0;

      return Carbon::parse($endTime)->diffInMinutes($startTime);
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
