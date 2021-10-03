<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\GradingRule;
use App\Models\Instance;
use App\Models\Meeting;
use App\Models\Registrant;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Member;

class ParticipantsExport implements FromQuery,Withheadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    
    public $from;
    public $to;
    public $meetin_id;
    public $category;
    public $gradingrule_id;


    public function __construct($params)
    {
        // dd($params);
      $this->from=Carbon::parse($params['_from'])->toDateTimeString();
      $this->to=Carbon::parse($params['_to'])->toDateTimeString();
      $this->meeting_id=$params['meeting_id'];
      $this->category=array_key_exists('category',$params)?$params['category']:"";
      $this->gradingrule_id=$params['gradingrule_id'];


    }

    public function headings(): array
    {
        return [
            'AttendanceTime',
            'Date',
            // 'Meeting',
            'Name',
            'Membership',
            'Email',
            'Category',
            'Club_Name',
            'Score'
        ];
    }

    public function query()
    {
        $instances= Instance::where('meeting_id',$this->meeting_id)
                                        ->where('official_start_time','>=',$this->from)
                                        ->where('official_end_time','<=',$this->to)
                                        ->with('participants')
                                        ->get();
    //   switch ($this->category) {
    //       case '':$instances= Instance::where('meeting_id',$this->meeting_id)
    //                                     ->where('official_start_time','>=',$this->from)
    //                                     ->where('official_end_time','<=',$this->to)
    //                                     ->whererHas('participants')
    //                                     ->with('participants')
    //                                     ->get();
    //           # code...
    //           break;
          
    //       default:$instances= Instance::where('meeting_id',$this->meeting_id)
    //                                     ->where('official_start_time','>=',$this->from)
    //                                     ->where('official_end_time','<=',$this->to)
    //                                     ->whereHas('participants', function($innerQuery) 
    //                                                             {
    //                                                                $innerQuery->whereHas('registrant', function ($query)
    //                                                                                      {
    //                                                                                             $query->where('registrants.category', 'LIKE', '%'.$this->category.'%')
    //                                                                                                   ->orWhere('registrants.category', 'LIKE', '%'.strtolower($this->category).'%');
    //                                                                                            });
    //                                                                                         })
    //                                     ->with('participants')->get();
    //           # code...
    //           break;
    //   }
        


    //  Order::whereHas('customer.country', function($innerQuery) {
    //             $innerQuery->where('countries.name', 'LIKE', 'Uk');
    //         })->get();


     $participants=collect([]);
     $part=collect([]);

     Schema::dropIfExists('temp');
     Schema::create('temp', function (Blueprint $table) 
        {
            $table->id();
            $table->string('meeting_id');
            $table->string('instance_uuid')->nullable();
            $table->date('instance_date')->nullable();
            $table->string('participant_id')->nullable();
            $table->string('name');
            $table->string('membership');
            $table->string('email');
            $table->string('category');
            $table->string('club_name');
            $table->string('mid');
            $table->integer('timeCredit');
            
       });

     foreach($instances as $instance)
       {
           foreach( $instance->participants()->get() as $participant)
                {
                    $membership=null;
                    if(Member::where('email',$participant->user_email)->exists())
                    {
                        $membership=Member::where('email',$participant->user_email)->first()->type_id;
                    }

                    $insertArray=['participant_id'=>$participant->id,
                                'name'=>$participant->name,
                                'email'=>$participant->user_email,
                                // 'join_time'=>Carbon::parse($participant->join_time)->toDateTimeString(),
                                // 'leave_time'=>Carbon::parse($participant->leave_time)->toDateTimeString(),
                                'meeting_id'=>$participant->meeting_id,
                                'instance_uuid'=>$participant->instance_uuid,
                                    'instance_date'=>$instance->official_start_time->toDateString(),
                                // 'instance_start_time'=>$instance->official_start_time->toDateTimeString(),
                                // 'instance_end_time'=>$instance->official_end_time->toDateTimeString(),
                                'mid'=>Meeting::where('meeting_id',$participant->meeting_id)->first()->topic,
                                'membership'=>$membership==1?'Member':'Inductee',
                                // 'start_time'=>Carbon::parse(Meeting::where('meeting_id',$participant->meeting_id)->first()->start_time)->toDateTimeString(),
                                'timeCredit'=>$participant->timeCredit(),
                                "category"=>(Registrant::where('email',$participant->user_email)->orderByDesc('id')->first())?Registrant::where('email',$participant->user_email)->orderByDesc('id')->first()->category:"",
                                "club_name"=>(Registrant::where('email',$participant->user_email)->orderByDesc('id')->first())?Registrant::where('email',$participant->user_email)->orderByDesc('id')->first()->club_name:"",

                                ];
                    if ($this->category=='')
                           DB::table('temp')->insert($insertArray);
                        elseif(DB::table('registrants')
                                    ->where('email',$participant->user_email)
                                    ->where('category','LIKE','%'.$this->category.'%')
                                    ->exists())
                                        {
                                            DB::table('temp')->insert($insertArray);
                                        }
                            
                   
                    
                }
         
       }
              
        
       return DB::table('temp')
                                ->select(DB::raw(' cast(sum(timeCredit) as int) as totalTime,instance_date,name,membership,email,category,club_name
                                    ,case when (cast(sum(timeCredit) as int)>'.GradingRule::firstWhere("id",$this->gradingrule_id)->threshhold.') then 1 else 0 end as score'))
                                ->where('timeCredit', '>',0)
                                ->groupByRaw('instance_date,name,membership,email,category,club_name')
                                ->orderByRaw('instance_date desc,email');
                                // ->orderBy('name');
                               // $groupedParticipants
        
    }

    
   
}
