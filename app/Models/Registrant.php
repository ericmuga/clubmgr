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

    protected $fillable=[
                  'meeting_id',
                  'uuid',
                  'occurrence_id',
                  'email',
                  'first_name',
                  'last_name',
                  'category',
                  'club_name',
                  'invited_by',
                  'classification',
                  'create_time'
                ];

   protected $dates=["create_time","created_at","deleted_at","updated_at"];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class ,'meeting_id');
    }



    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('meeting_id', 'like', '%'.$search.'%')
                      ->orWhere('email', 'like', '%'.$search.'%')
                      ->orWhere('first_name', 'like', '%'.$search.'%')
                      ->orWhere('last_name', 'like', '%'.$search.'%')
                      ->orWhere('category', 'like', '%'.$search.'%')
                      ->orWhere('club_name', 'like', '%'.$search.'%')
                      ->orWhere('invited_by', 'like', '%'.$search.'%')
                      ->orWhere('classification', 'like', '%'.$search.'%')
                      ->orWhere('create_time', 'like', '%'.$search.'%')
                      ->orWhereHas('meeting', function ($query) use ($search) {
                                $query->where('meeting_id', 'like', '%'.$search.'%');
                            });
                      // ->orWhereHas('types', function ($query) use ($search) {
                      //           $query->where('code', 'like', '%'.$search.'%');
                      //      });
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
