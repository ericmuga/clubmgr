<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    
    protected $table='meetings';
    protected $fillable= [
                        "uuid",
                        "meeting_id",
                        "host_id",
                        "topic",
                        "type",
                        "start_time",
                        "duration",
                        "timezone",
                        "created_at",
                        "join_url",
                        "meeting_type"
             ];

    protected $dates=["start_time","created_at","updated_at"];

   
    public function registrants()
    {
       return $this->hasMany(Registrant::class,'meeting_id','meeting_id'); 
    }


    public function getMeetingTypeAttribute($value)
    {
        switch ($value) {
            case 1:return "Physical";
                // code...
                break;
            case 2:return "Zoom";
            // code...
            break;
            
            default:return "Undefined";
                // code...
                break;
            }
   }


   // public function setMeetingTypeAttribute($value)
   //  {
   //      switch ($value) {
   //          case "Physical":$this->attributes['meeting_type'] = 1;
   //              // code...
   //              break;
   //          case "Zoom":return $this->attributes['meeting_type'] = 2;
   //          // code...
   //          break;
            
   //          default:return 0 ;
   //              // code...
   //              break;
   //          }
   // }


      
  public function participants()
    {
       return $this->hasMany(Participant::class,'meeting_id','meeting_id'); 
    }
 


    public static function filteredMeetings($searches)
    {
        return
                     Meeting::where(function($q) use ($searches)
                                                {
                                                   foreach($searches as $key => $value)
                                                   { 
                                                      if ($key=="from")
                                                        {
                                                            $q->where("start_time", '>=', $value);
                                                        }
                                                       elseif ($key=="to") 
                                                       {
                                                          $q->where("start_time", '<=', $value); // code...
                                                       }
                                                       else
                                                       {
                                                          $q->where($key, 'like',"%". $value."%");
                                                       }
                                                   }
                                                })->with ('registrants');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('uuid', 'like', '%'.$search.'%')
                ->orWhere('meeting_id', 'like', '%'.$search.'%')
                    ->orWhere('start_time', 'like', '%'.$search.'%')
                    ->orWhere('meeting_type', 'like', '%'.$search.'%')
                    ->orWhere('topic', 'like', '%'.$search.'%');
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
