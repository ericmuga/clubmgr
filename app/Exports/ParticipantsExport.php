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
    public $sql;


    public function __construct($params)
    {
        // dd($params);
      $this->from=Carbon::parse($params['_from'])->toDateTimeString();
      $this->f=Carbon::parse($params['_from'])->toDateTimeString();
      $this->to=Carbon::parse($params['_to'])->toDateTimeString();
      $this->t=Carbon::parse($params['_to'])->toDateTimeString();
      $this->meeting_id=$params['meeting_id'];
      $this->category=array_key_exists('category',$params)?$params['category']:"";
      $this->gradingrule_id=$params['gradingrule_id'];

     
    }



    

    public function query()
    {
        $instances= Instance::where('meeting_id',$this->meeting_id)
                                        ->where('official_start_time','>=',$this->from)
                                        ->where('official_end_time','<=',$this->to)
                                        ->with('participants')
                                        ->get();
    

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
            $table->datetime('join_time');
            $table->dateTime('leave_time');
            $table->string('category');
            $table->string('club_name');
            $table->string('mid');
            // $table->integer('timeCredit');
            
       });




     //get distinct participants for each instance


    //    dd($excludeList);

    

    // $toDrop1=collect([]);
        
     foreach($instances as $instance)
       {
           foreach( $instance->participants()->get() as $participant)
                {
                    //skip any join and leave before start time
                    if (($participant->join_time<=$instance->official_start_time) and ($participant->leave_time<=$instance->official_start_time)) 
                    {
                        // if(!$toDrop->contains($item->email,$item->uuid)) 
                        // {
                        //     //$toDrop1->push([$participant->user_email=>$participant->instance_uuid ,'duration'=>0]); 
                        //     continue;
                        // }
                    }
                    
                    $membership=null;
                    if(Member::where('email',$participant->user_email)->exists())
                    {
                        $membership=Member::where('email',$participant->user_email)->first()->type_id;
                    }

                    $insertArray=['participant_id'=>$participant->id,
                                'name'=>$participant->name,
                                'email'=>$participant->user_email,
                                'join_time'=>Carbon::parse($participant->join_time)->toDateTimeString(),
                                'leave_time'=>Carbon::parse($participant->leave_time)->toDateTimeString(),
                                'meeting_id'=>$participant->meeting_id,
                                'instance_uuid'=>$participant->instance_uuid,
                                    'instance_date'=>$instance->official_start_time->toDateString(),
                                // 'instance_start_time'=>$instance->official_start_time->toDateTimeString(),
                                // 'instance_end_time'=>$instance->official_end_time->toDateTimeString(),
                                'mid'=>Meeting::where('meeting_id',$participant->meeting_id)->first()->topic,
                                'membership'=>$membership==1?'Member':'non-member',
                                // 'start_time'=>Carbon::parse(Meeting::where('meeting_id',$participant->meeting_id)->first()->start_time)->toDateTimeString(),
                                // 'timeCredit'=>$participant->timeCredit(),
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

       //grade the entries
       //1. group by email, order by join_time
           $orderedList= DB::table('temp')
               ->select(DB::raw('instances.uuid,temp.email,temp.join_time,temp.leave_time,instances.official_end_time'))
               ->join('instances','instance_uuid','=','instances.uuid')
               ->orderByRaw('instances.uuid,temp.email,temp.join_time')
               ->get();

      //eliminate if ealiest join time is >instnace official start time
       $currentEntry='';
       $toDrop=collect([]);
       
       
       foreach($orderedList as $item)
        {
            if ($currentEntry!=$item->email.$item->uuid)
            {
                    if ($item->join_time>=$item->official_end_time)
                    {
                        if(!$toDrop->contains($item->email,$item->uuid)) 
                        {
                           $toDrop->push([$item->email=>$item->uuid,'duration'=>0]);
                            DB::table('temp')
                            ->where('instance_uuid',$item->uuid)
                            ->where('email',$item->email)
                            ->delete();
                        }

                    }
            }
            $currentEntry=$item->email.$item->uuid;
        }

        //check time
        $refinedList=DB::table('temp')
            ->select(DB::raw('temp.*,(TIME_TO_SEC(leave_time)-TIME_TO_SEC(join_time))/60 as duration'))
            ->orderByRaw('instance_uuid,email')
            ->get();

        $currentEntry='';
        $prevSessionEnd=null;
        $attendance=collect([]);
        foreach ($refinedList as $item)
        {
          if($attendance->contains($item->email,$item->instance_uuid)) continue;
            if ($currentEntry!=$item->email.$item->instance_uuid)
            {
                    $counter=0;
                    $currentEntry=$item->email.$item->instance_uuid;
                    $prevSessionEnd=$item->leave_time;

                    if ($item->duration<30)
                    {
                        
                            $counter+=$item->duration;
                        
                    }
                    else{
                        $attendance->push(['email'=>$item->email,'instance_uuid'=>$item->instance_uuid,'duration'=>$counter]);
                        continue;
                    }  
            }
            else
            {
                if((Carbon::parse($item->join_time)->diffInMinutes(Carbon::parse($prevSessionEnd)))<=30) 
                {
                    $counter+=$item->duration;
                    if ($counter>=30) 
                      {
                          $attendance->push(['email'=>$item->email,'instance_uuid'=>$item->instance_uuid,'duration'=>$counter]);
                          continue;
                      }
                     
                }
            }

            
        }

        //dd($attendance->values()->toArray());


        Schema::dropIfExists('temp_attendance');
        Schema::create('temp_attendance', function (Blueprint $table) 
           {
               $table->id();
               $table->string('instance_uuid');
               $table->string('email');
               $table->integer('duration');
               $table->integer('score');
               
          });

          foreach ($attendance->values()->toArray() as $item)
          {
               DB::table('temp_attendance')->insert(['email'=>$item['email'],'instance_uuid'=>$item['instance_uuid'],'duration'=>$item['duration'],'score'=>1]);

          }

          $all=DB::table('temp')
                 ->select(DB::raw('email,instance_uuid'))->get();
      
        //dd($all);
       foreach($all as $item)
        {
            if(!DB::table('temp_attendance')->where('email',$item->email)->where('instance_uuid',$item->instance_uuid)->exists())
            {
                DB::table('temp_attendance')->insert(['email'=>$item->email,'instance_uuid'=>$item->instance_uuid,'duration'=>0,'score'=>0]);
            }
        }

        
        $penultimate= DB::table('temp_attendance')
                        ->select(DB::raw('
                            distinct
                            temp_attendance.duration,
                            DATE(instances.official_start_time) as instance_date,
                            participants.name,
                            case when (ifnull(members.email,"non-member"))<>"non-member" then "member" else "non-member" end as membership,
                            temp_attendance.email,
                            registrants.category,
                            temp_attendance.score
                            
                            '))
                        ->join('instances','instances.uuid','=','temp_attendance.instance_uuid')
                        ->join('participants','temp_attendance.email','=','participants.user_email')
                        ->leftJoin('members','temp_attendance.email','=','members.email')
                        ->join('registrants','temp_attendance.email','=','registrants.email')
                        ->orderByRaw('temp_attendance.instance_uuid,temp_attendance.email')
                        ->get();
            //dd($penultimate->unique()->values()->all());

        // Schema::dropIfExists('temp_attendance');

        Schema::dropIfExists('temp_grouped');
        Schema::create('temp_grouped', function (Blueprint $table) 
           {
               $table->id();
            //   $table->string('duration');
               $table->date('instance_date');
               $table->string('name');
               $table->string('membership');
               $table->string('email');
               $table->string('category');
               $table->integer('score');
               
          });



            foreach($penultimate as $item)
            {
                if(!DB::table('temp_grouped')->where('email',$item->email)->where('instance_date',$item->instance_date)->exists())
                // dd(collect($item)->toArray());
                DB::table('temp_grouped')->insert( [
                                                 
                                                 'instance_date'=>$item->instance_date,
                                                  'name'=>$item->name,
                                                  'membership'=>$item->membership,
                                                  'email'=>$item->email,
                                                  'category'=>$item->category,
                                                  'score'=>$item->score
                                                  
                                                   ]);
            }
         
          //return  DB::table('temp_grouped')->select(DB::raw('instance_date,name,membership,email,category,score'))->orderByRaw('instance_date,email');
            
             

            
            
        

             
       
      
        
    //    dd('here');
       Schema::dropIfExists('temp_grouped_dates');
       Schema::create('temp_grouped_dates', function (Blueprint $table) 
          {
              $table->id();
              $table->string('email');
              $instance_dates=DB::table('temp_grouped')->select('instance_date')->groupBy('instance_date')->orderBy('instance_date')->get();
              foreach ($instance_dates as $instance_date)
              {
                //   dd($instance_date);
                  $table->integer(preg_replace('/-/', '_', Carbon::parse($instance_date->instance_date)->setTimezone('GMT +3:00')->toDateString()))->default(0);
                  
              }
              //$table->integer('total_score');
              
         });
       
          
         // insert into this table
         $array_grouped=collect([]);
         $emails=DB::table('temp_grouped')->select(DB::raw('distinct email'))->get();
         //dd($emails);
         $arr=[];$counter=0;
         foreach($emails as $item)
         {  
            
             $arr[$counter]['email']=$item->email;
           
            $instance_dates=DB::table('temp_grouped')->select('instance_date')->groupBy('instance_date')->orderBy('instance_date')->get();
             foreach($instance_dates as $instance_date )
             
             {
                 $arr[$counter][
                     preg_replace('/-/', '_', Carbon::parse($instance_date->instance_date)->setTimezone('GMT +3:00')->toDateString())]
                   =(DB::table('temp_grouped') 
                        ->select('score')
                        ->where('email',$item->email)
                        ->where('instance_date',$instance_date->instance_date)
                        ->where('score',1)
                        ->exists())?1:0;
                    
               DB::table('temp_grouped_dates')->updateOrInsert(['email'=>$item->email],$arr[$counter]);  
                 
                
             }
             //dd(collect(collect($arr)->first())->values());
             //dd(DB::table('temp_grouped_dates')->select('*')->get());
            $counter++;          
         }

         $instance_dates=DB::table('temp_grouped')->select('instance_date')->groupBy('instance_date')->orderBy('instance_date')->get();
         $string='';
         foreach($instance_dates as $date){

            $string.=preg_replace('/-/', '_', Carbon::parse($date->instance_date)->setTimezone('GMT +3:00')->toDateString()).',';
         }
          $string=rtrim($string, ", ");


            
        //   dd($string);
        return DB::table('temp_grouped_dates')
                ->select(DB::raw('distinct temp_grouped_dates.email,
                                 temp_grouped.name,
                                 temp_grouped.membership,
                                 temp_grouped.category,

                                '.$string
                          ))
                ->join('temp_grouped','temp_grouped.email','=','temp_grouped_dates.email')
                ->orderBy('temp_grouped_dates.name');
               

        


    }
    public function headings(): array
    {
        $arr=['Email', 
            'Name',
            'Membership',
            'Category'];
            $instance_dates=DB::table('temp_grouped')->select('instance_date')->groupBy('instance_date')->orderBy('instance_date')->get();
            $string='';
            foreach($instance_dates as $date)
            {
   
               array_push($arr,preg_replace('/-/', '_', Carbon::parse($date->instance_date)->setTimezone('GMT +3:00')->toDateString()));
            }
       //dd($arr); 
        return $arr;
        
        
        
    }
    
   
}
