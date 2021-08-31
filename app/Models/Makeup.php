<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Makeup extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='makeups';
    protected $fillable=['email','makeup_date','approved_by','approval_date','status','name','description'];

    protected $dates=['makeup_date','approval_date'];

    public function member()
    {
        return $this->belongsTo(Member::class ,'email');
    }

      
    public function wstatus()
    {
        switch ($this->status) {
            case 1: return "Requested"; break;
            case 2: return "Approved"; break;
            case 3: return "Declined"; break;
             
        }
    }


      public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('approval_date', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('approved_by', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->orWhere('makeup_date', 'like', '%'.$search.'%')
                    ->orWhere('status', 'like', '%'.$search.'%');

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
