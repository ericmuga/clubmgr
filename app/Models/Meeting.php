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
       return $this->hasMany(Registrant::class); 
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('uuid', 'like', '%'.$search.'%')
                ->orWhere('meeting_id', 'like', '%'.$search.'%')
                    ->orWhere('start_time', 'like', '%'.$search.'%')
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
