<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Affiliation;
use App\Models\Instance;
use App\Models\Participant;
use App\Models\Type;
use App\Models\MemberContacts;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\GradingRule;


class Member extends Model
{
    use HasFactory;
     use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable=['name','email','affiliation_id','type_id','active','phone','sector','gender'];     
     
    
    public function memberEmails()
    {
        return DB::table('member_contacts')
                  ->select('contact')
                  ->where('member_id',$this->id)
                  ->where('contact_type','like','%email%');
    }
    
    public function instanceAttended($uuid)
    {
       $rule=GradingRule::first();


       $memberEmails=DB::table('member_contacts')
                  ->select('contact')
                  ->where('member_id',$this->id)
                  ->where('contact_type','like','%email%');

       if(DB::table('participants')
                 ->join('instances', fn($q)=>($q->on('participants.instance_uuid','=','instances.uuid')
                                                  // ->on('participants.join_time','<=','instances.official_end_time')
                                    ))
                 ->where('instances.uuid',$uuid)
                 ->where('instances.marked_for_grading',true)
                 ->whereIn('user_email',$memberEmails)
                 ->count()==0) return 0;

      //if($uuid=='Gy1GB0HwSReTXtQ/S9Sb1Q==') dd('here');


       $logins=DB::table('participants')
                 ->selectRaw('participant_id,join_time,leave_time,instances.official_end_time')
                 ->join('instances', fn($q)=>($q->on('participants.instance_uuid','=','instances.uuid')
                                                  // ->on('participants.join_time','<=','instances.official_end_time')
                                    ))
                 ->whereIn('user_email',$memberEmails)
                 ->where('instances.uuid',$uuid)
                 ->where('instances.marked_for_grading',true)
                 ->orderBy('join_time')->get();
        
        //dd($logins);

         if ($logins->count()<=0) return 0;
        
           $timer=0;$min=0;$prevendTime=null;

           foreach($logins as $login)
           {
              if (($timer==0)&&($login->join_time>$login->official_end_time)) return 0;
             //dd((ABS(Carbon::parse($login->join_time)->diffInMinutes($login->leave_time))));
             $timer++;


                 if ((ABS(Carbon::parse($login->join_time)->diffInMinutes($login->leave_time))>=$rule->threshhold) and ($timer==1)) return 1;
                 else
                 { //dd('here');
                    if ($timer==1) 
                    {
                        $prevendTime=$login->leave_time;
                        $min+=ABS(Carbon::parse($login->join_time)->diffInMinutes($login->leave_time));
                    }
                    else{
                        if(ABS(Carbon::parse($prevendTime)->diffInMinutes($login->join_time))<=$rule->threshhold)
                          {
                            
                            $min+=ABS(Carbon::parse($login->join_time)->diffInMinutes($login->leave_time));
                            if ($min>=$rule->threshhold) return 1; 
                            $prevendTime=$login->leave_time;
                          }
                      }

                    
                  }
                    
                      
            } 
             

           //dd('here');
           
        return 0; 
    }
         
        

    public function member_contacts()
    {
        return $this->hasMany(MemberContacts::class,'member_id','id');
    }

    public function emails()
    {
        return MemberContacts::where('contact_type','like','%email%')
                               ->where('member_id',$this->id)->get();
    }

    public function phones()
    {
        return MemberContacts::where('contact_type','like','%phone%')
                               ->where('member_id',$this->id)->get();
    }
        

    public function types()
     {
         return $this->belongsTo(Type::class,'type_id');
     }
 
    public function affiliations()
    {
        return $this->belongsTo(Affiliation::class,'affiliation_id');
    }


    public function tp()
     {
         return Type::findOrFail($this->type_id)->code;
     }
 
    public function afl()
    {
        return Affiliation::find($this->affiliation_id)->code;
    }


    // public function makeups ()
    // {
    //     return $this->hasMany(Makeup::class,'email','email');
    // }


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
                ->orWhere('member_id', 'like', '%'.$search.'%')
                //->orWhere('phone', 'like', '%'.$search.'%')
                  //  ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('sector', 'like', '%'.$search.'%')
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
