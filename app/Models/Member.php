<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Affiliation;
use App\Models\Type;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable=['name','email','affiliation_id','type_id','active','phone'];     
     
    public function types()
     {
         return $this->belongsToMany(Type::class);
     }
 
    public function affiliations()
    {
        return $this->belongsToMany(Affiliation::class);
    }


    public function tp()
     {
         return Type::findOrFail($this->type_id)->code;
     }
 
    public function afl()
    {
        return Affiliation::find($this->affiliation_id)->code;
    }



     public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }

     public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('phone', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhereHas('affiliations', function ($query) use ($search) {
                        $query->where('code', 'like', '%'.$search.'%');
                    })
                    ->orWhereHas('types', function ($query) use ($search) {
                        $query->where('code', 'like', '%'.$search.'%');
                    });
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
