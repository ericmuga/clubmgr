<?php

namespace App\Http\Controllers;

use App\Models\Instance;
use App\Models\Meeting;
use App\Models\Participant;
use App\Models\GradingRule;
use App\Models\Registrant;
use App\Models\Recording;
use Carbon\Carbon;
use App\Zoom;
use Illuminate\Http\Request;
use App\Paginater;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InstanceExport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use App\Imports\ParticipantsImport;
use App\Exports\InstanceParticipantsExport;
use App\Models\Member;
use App\Models\MemberContacts;
use Illuminate\Support\Facades\DB;
use File;

// use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class InstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadParticipants(Request $request)
    {
    //   dd($request->all());

      Excel::import(new ParticipantsImport($request->instance_id), request()->file('participantList')); 
      return redirect()->back()->with('success','Participants imported successfully');
    }    

    public function generateTemplate(Instance $instance, Request $request)
    {
          //get the template for this instance
            //2. Create one if it doesnt exist
            //3. Download one.

            $slug = Str::of(Carbon::now()->todateTimeString())->slug('_');     
           
            // dd($instance->uuid);
            Excel::store(new InstanceParticipantsExport($instance->uuid), $slug.'.xlsx');
            
             File::move(storage_path('app/'.$slug.'.xlsx'), public_path('templates/'.$slug.'.xlsx'));
            
     return Inertia::render('Instances/Edit',[   "participants"=>$instance->participants()
                                                    ->orderBy("name")
                                                     ->paginate(10)
                                                     ->through(fn($participant)=>([
                                                         "name"=>$participant->name, 
                                                         "id"=>$participant->id, 
                                                         "category"=>(Registrant::where('email',$participant->user_email)->first())?Registrant::where('email',$participant->user_email)->first()->category:"",
                                                         "club_name"=>(Registrant::where('email',$participant->user_email)->first())?Registrant::where('email',$participant->user_email)->first()->club_name:"",
                                                         "join_time"=>Carbon::parse($participant->join_time)->toDateTimeString(), 
                                                         "official_start_time"=>($instance->official_start_time==null)?null:Carbon::parse($instance->official_start_time)->toDateTimeString(), 
                                                         "official_end_time"=>($instance->official_end_time==null)?null:Carbon::parse($instance->official_end_time)->toDateTimeString(), 
                                                         "leave_time"=>Carbon::parse($participant->leave_time)->toDateTimeString(), 
                                                         "duration"=>Carbon::parse($participant->leave_time)->diffInMinutes(Carbon::parse($participant->join_time)),
                                                         "time_credit"=>$participant->timeCredit()
                                                     ])),
                "instance"=>[
                                        "id"=>$instance->id,
                                        "uuid"=>$instance->uuid,
                                        "meeting_id"=>$instance->meeting_id,
                                        "topic"=>Meeting::firstWhere('meeting_id',$instance->meeting_id)->topic,
                                        "start_time"=>Carbon::parse($instance->start_time)->toDateTimeString(),
                                        "attendance_rule_id"=>$instance->attendance_rule_id,
                                        "official_start_time"=>($instance->official_start_time==null)?null:$instance->official_start_time->toDateTimeString(),
                                        "official_end_time"=>($instance->official_end_time==null)?null:$instance->official_end_time->toDateTimeString(),
                                        "grading_rule_id"=>$instance->grading_rule_id,
                                        "marked_for_grading"=>$instance->marked_for_grading,
                                        "meeting"=>$instance->meeting->id,
                                        "template"=>url('templates/'.$slug.'.xlsx'),
                                        ],
                                        "gradingrules"=>collect(GradingRule::where('meeting_type',$instance->meeting()->first()->meeting_type=='Zoom'?1:2)->get()),

                        ])->with('success','Template generated successfully!');
 
    }



     public static function attendanceList(Instance $instance, $search=null)
        {
            (!$search)?
            $part= $instance->participants()
                            ->select('user_email')
                            ->groupBy('user_email')
                            ->get()
                            ->pluck('user_email'):
           $part= Participant::where('instance_uuid',$instance->uuid)
                              ->where('name', 'like', '%'.$search.'%')
                              // ->orWhereHas('member_contacts', fn($q)=>($q->whereHas('member',fn($query)=>($query->where('type_id')))))
                                ->select('user_email')
                                ->groupBy('user_email')
                                ->get()
                                ->pluck('user_email');
            
             $list=collect([]);
            $contact_exists=false; $registrant_exists=false;
            foreach ($part as $value) 
            {
                
                  $registrant=null;$member=null;$membership='';$category='';

                  $contact_exists=MemberContacts::where('contact',$value)->exists();
                  if ($contact_exists) $member=MemberContacts::firstWhere('contact',$value)->member()->first();

                  $registrant_exists=Registrant::where('email',$value)->exists();
                  if($registrant_exists)$registrant=Registrant::Where('email',$value)->first();
                  

                  if($member){

                    switch ($member->type_id) {
                        case 1:$membership='member'; break;
                        case 2:$membership='inductee'; break;
                        case 3:$membership='non-member'; break;
                            // code...
                            
                        
                        default:$membership='';
                            // code...
                            break;
                    }

                    switch ($member->affiliation_id) {
                        case 1:$category='Rotarian'; break;
                        case 2:$category='Rotaractor'; break;
                        case 3:$category='Guest'; break;
                           
                        
                        default:$category='';
                            // code...
                            break;
                    }
                  }

                  //if ($value=='kabichongina@gmail.com') dd($membership);
                  // dd($member->instanceAttended($instance->uuid));
                $list->push([
                                     'name'=>($member!=null)?$member->name:'',
                                     'email'=>$value,
                                 'club_name'=>($registrant!=null)?$registrant->club_name:'',
                                'membership'=>($member!=null)?$membership:'',
                                  'category'=>($member!=null)?$category:'',
                                  'score'=>($member!=null)?$member->instanceAttended($instance->uuid):0,
                             // 'instance_date'=>Carbon::parse($instance->official_start_time)->toDateString()
                              
                           ]);
               
            }
            
            if (($search=='Rotarian') 
                // ||
                //  ($search=='Rotaractor') ||
                //  ($search=='Guest')
             )
                
                return  $list->where('name','<>','')
                             // ->where('category','=',$search)
                              ->unique();

            return  $list->where('name','<>','')->unique();
           
        }

     public function paginate($items, $perPage = 5, $page = null, $options = [],$baseUrl=null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);


        $lap= new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

         if ($baseUrl) {
                    $lap->setPath($baseUrl);
                }

        return $lap;
              
    }

     

    public function edit(Request $request, Instance $instance)
    {
        // dd($request->all());

        ($request->has('search'))?$list=$this->attendanceList($instance,$request->search):$list=$this->attendanceList($instance,null);
        
          $contacts=DB::table('participants')
                        ->selectRaw('DISTINCT member_contacts.member_id')
                        ->join('member_contacts','participants.user_email','=','member_contacts.contact')
                         ->where('member_contacts.contact_type','email')
                         // ->groupBy('member_id')
                        ->where('participants.instance_uuid',$instance->uuid);
                        // ->groupBy('member_contacts.contact')->get();
       ($request->has('search2'))?
                        $notAttended=DB::table('members')
                            ->select('member_contacts.contact as email','members.name','members.id','member_contacts.contact_type')
                            ->where('members.name','like','%'.$request->search2.'%')
                            // ->orWhere('member_contacts.contact','like','%'.$request->search2.'%')
                            // ->join('member_contacts','member_contacts.member_id','=','members.id')
                            ->where('member_contacts.contact_type','email')
                            ->whereNotIn('member_contacts.member_id',$contacts)
                            ->get()

                            :
       $notAttended=DB::table('members')
                            ->select('member_contacts.contact as email','members.name','members.id','member_contacts.contact_type')
                            ->join('member_contacts','member_contacts.member_id','=','members.id')
                            ->where('member_contacts.contact_type','email')
                            ->whereNotIn('member_contacts.member_id',$contacts)
                            ->get();

           //remove duplicate members   

           // dd($notAttended->first());              
           $prevId=null;
           
           //dd($notAttended);
        foreach ($notAttended as $key=>$value) 
           {
               if ($value->contact_type=='phone') $notAttended->pull($key);
               if ($value->id==$prevId) {$notAttended->pull($key);}
                $prevId=$value->id;
               
           }

            foreach ($list->pluck('email') as $value) 
            {
                 foreach ($notAttended as $key=>$v) 
                   {
                       if ($v->email==$value) $notAttended->pull($key);
                   }
            }


         
          

           return Inertia::render('Instances/Edit',[
                                          'filters' =>$request->all('search','trashed'),
                                          'filters2' =>$request->all('search2','trashed2'),
                                          
                                    "members"=>$this->paginate($notAttended,20,null,[],$request->url()),
                                    "participants"=>$this->paginate($list->sortBy('name'),30,null,[],$request->url()),
                                           "instance"=>[
                                                        'xlxs'=>$request->session()->get('instance_xls',''),
                                                        "guests"=>$list->where('category','Guest')->count(),
                                                        "guests_present"=>$list->where('category','Guest')->where('score',1)->count(),
                                                        
                                                        "members"=>$list->where('membership','member')->count(),
                                                        "members_present"=>$list->where('membership','member')->where('score',1)->where('category','Rotarian')->count(),
                                                        
                                                        "Rotarian"=>$list->where('category','Rotarian')->count(),
                                                        "Rotarian_present"=>$list->where('category','Rotarian')->where('score',1)->count(),
                                                        
                                                        "Rotaractor"=>$list->where('category','Rotaractor')->count(),
                                                        "Rotaractor_present"=>$list->where('category','Rotaractor')->where('score',1)->count(),
                                                        "marked_present"=>$list->where('score',1)->count(),
                                                        "marked_absent"=>$list->where('score',0)->count(),
                                                        "total"=>$list->count(),
                                                        "Rotarian"=>$list->where('category','Rotarian')->count(),
                                                               "id"=>$instance->id,
                                                              
                                                              "official_start_time"=>($instance->official_start_time==null)?null:$instance->official_start_time->toDateTimeString(),
                                                              "official_end_time"=>($instance->official_end_time==null)?null:$instance->official_end_time->toDateTimeString(),
                                                              // "grading_rule_id"=>$instance->grading_rule_id,
                                                              "marked_for_grading"=>$instance->marked_for_grading,
                                                              "meeting"=>$instance->meeting->id
                                                      ],

                                                   "gradingrules"=>collect(GradingRule::where('meeting_type',$instance->meeting()->first()->meeting_type=='Zoom'?1:2)->get()),

                                            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    


    public function addParticipant(Request $request)
    {
       

        $instance=Instance::find($request->instance);
        if(!Participant::where('user_email',$request->member['email'])
                       ->where('instance_uuid',$instance->uuid)->exists())
        Participant::create([
                               'meeting_id'=>$instance->meeting_id,
                               'instance_uuid'=>$instance->uuid,
                               'user_id'=>md5($request->member['email'].now()->todateTimeString()),
                               'name'=>$request->member['name'],
                               'user_email'=>$request->member['email'],
                               'join_time'=>$instance->official_start_time,
                               'leave_time'=>$instance->official_end_time,
                               'duration'=>Carbon::parse($instance->official_end_time)->diffInMinutes($instance->official_start_time),
                               'registrant_id'=>''
                             ]);

        return redirect()->back();//->with('success','Participant added successfully!');
    }

    public function addNewParticipant(Request $request)
    {
        //dd($request->all());
        $instance=Instance::find($request->instance_id);

        // dd($instance);
       $validate=$request->validate([
                                      // 'contact'=>['unique:member_contacts','required'],
                                      'name'=>['required'],
                                      'member_id'=>'sometimes|nullable|unique:members',
                                    ]);

        $member=Member::create([ 
                         'member_id'=>($request->has('member_id'))?$request->member_id:null,
                         'sector'=>($request->has('sector'))?$request->has('sector'):'',
                         'name'=>$request->name,

                         'type_id'=>$request->membership,
                         'affiliation_id'=>$request->category,
                         'active'=>1,
                         'gender'=>$request->gender,    

                     ]);

     if(!MemberContacts::where('contact',$request->contact)->exists())
             MemberContacts::create([ 'member_id'=>$member->id,
                                       'contact_type'=>'email',
                                       'contact'=>$request->contact,
                                     ]);
       
       
        switch ($request->category) {
            case '1':$category='Rotarian'; break;
            case '2':$category='Rotaractor'; break;
            case '3':$category='Guest'; break;
            default:$category='Guest';  break;
        }
if(!Registrant::where('email',$request->contact)
             ->where('meeting_id',$instance->meeting_id)->exists())
        Registrant::create([
                            'meeting_id'=>$instance->meeting_id,
                            'uuid'=>'',
                            'occurrence_id'=>'',
                            'email'=>$request->contact,
                            'first_name'=>$request->name,
                            'last_name'=>'',
                            'category'=>$category,
                            'club_name'=>($request->has('club_name'))?$request->has('club_name'):'',
                            'invited_by'=>($request->has('invited_by'))?$request->has('invited_by'):'',
                            'classification'=>($request->has('sector'))?$request->has('sector'):'',
                            'create_time'=>now()

                           ]);

        if(!Participant::where('user_email',$request->contact)
                       ->where('instance_uuid',$instance->uuid)
                       ->where('user_id',$request->contact)
                       ->exists())
                        Participant::create([
                                               'meeting_id'=>$instance->meeting_id,
                                               'instance_uuid'=>$instance->uuid,
                                               'user_id'=>md5($request->contact.now()->todateTimeString()),
                                               'name'=>$request->name,
                                               'user_email'=>$request->contact,
                                               'join_time'=>$instance->official_start_time,
                                               'leave_time'=>$instance->official_end_time,
                                               'duration'=>Carbon::parse($instance->official_end_time)->diffInMinutes($instance->official_start_time),
                                               'registrant_id'=>''
                                             ]);

         return redirect()->back()->with('success','Participant added successfully!');
    }


     public function removeParticipant(Request $request)
    {
       //dd($request->all());

        $instance=Instance::find($request->instance);
        DB::table('participants')->where('user_email',$request->participant['email'])
                       ->where('instance_uuid',$instance->uuid)->delete();
        
        return redirect()->back();//->with('success','Participant removed successfully!');
    }


public static function createInstanceRegistrant($meeting_id,$registrant,$qs)
    {
        if(!Registrant::where("email",$registrant["email"])
                        ->where("uuid",$qs["occurrence_id"])
                        ->where("meeting_id",$meeting_id)->exists())
        {
            $createTime=Carbon::parse($registrant["create_time"])->timezone('Africa/Nairobi');
            Registrant::create([
                                  'meeting_id'=>$meeting_id,
                                  'uuid'=>$qs["occurrence_id"],
                                  'registrant_id'=>$registrant["id"],
                                  'email'=>$registrant["email"],
                                  'first_name'=>array_key_exists("first_name", $registrant)?$registrant["first_name"]:"",
                                  'last_name'=>array_key_exists("last_name", $registrant)?$registrant["last_name"]:"",
                                  'category'=>$registrant["custom_questions"][0]["value"],
                                  'club_name'=>$registrant["custom_questions"][1]["value"],
                                  'invited_by'=>$registrant["custom_questions"][2]["value"],
                                  'classification'=>array_key_exists(3, $registrant["custom_questions"])?$registrant["custom_questions"][3]["value"]:"",
                                  'create_time'=>$createTime
                             ]);
        }




    }


    
    public static function fetchInstanceRecordings(Request $request, Instance $instance)
    {

       if (!strpos($instance->uuid, "/"))
            $uuid=$instance->uuid;
        else {
            $uuid=urlencode($instance->uuid);
            $uuid=urlencode($uuid);
        }

         $token=Zoom::getToken($request);
         $url="https://api.zoom.us/v2/meetings/".$uuid."/recordings";
         $qs=["instance_uuid"=>$instance->uuid];
         $items=Http::withToken($token)->get($url);
         $obj=collect($items->json());
        //  dd($obj->values()->toArray());
         if (array_key_exists(12,$obj->values()->toArray()))
         {
            foreach (collect($obj->values()[12]) as  $recording) 
            {
                //dd($recording);
                if(!Recording::where("recording_id",$recording["id"])
                            ->where("instance_uuid",$instance->uuid)
                            ->exists())
                    {
                        $startTime=Carbon::parse($recording["recording_start"])->timezone('Africa/Nairobi');
                        $endTime=Carbon::parse($recording["recording_end"])->timezone('Africa/Nairobi');
                        Recording::create([
                                            'recording_id'=>$recording['id'],
                                            'meeting_id'=>$instance->meeting_id,
                                            'instance_uuid'=>$instance->uuid,
                                            'file_type'=>$recording["file_type"],
                                            'file_size'=>$recording["file_size"],
                                            'play_url'=>'',//array_key_exists("play_url",$recording)?$recording["play_url"]:"",
                                            'download_url'=>'',//array_key_exists("download_url",$recording)?$recording["download_url"]:"",
                                            'recording_type'=>'',//array_key_exists("recording_type",$recording)?$recording["recording_type"]:"",
                                            'status'=>$recording["status"],
                                            'recording_start'=>$startTime,
                                            'recording_end'=>$endTime
                                        ]);
                    
                }
            }
        }
        
        $earliest=Recording::where("instance_uuid",$instance->uuid)
                        ->orderBy('recording_start')->first();

        $latest=Recording::where("instance_uuid",$instance->uuid)
                        ->orderByDesc('recording_end')->first();

        if ($earliest!=null)
        {
            $instance->official_start_time=$earliest->recording_start;
            $instance->official_end_time=$latest->recording_end;
            $instance->save();
        }
        

              
    }


 public function fetchInstanceRegistrants(Request $request, Instance $instance)
    {
         $meeting=Meeting::firstWhere('meeting_id',$instance->meeting_id);
          
         $url="https://api.zoom.us/v2/meetings/".$meeting->meeting_id."/registrants?occurrence_id=".$instance->uuid;
         $page_size=50;
         $mode='instanceRegistrants';
         $valueKey=3;
         $qs=["occurrence_id"=>$instance->uuid];

          $next_page=""; 
          $next_page_key=2;
          if ($next_page=="")
                {
                     $t=Zoom::callZoom($request,$page_size,$next_page,$url,$mode,$meeting->meeting_id,$valueKey,$next_page_key,$qs);
                    $next_page=$t;
                }
            while ($next_page!="") 
            {
                $t=Zoom::callZoom($request,$page_size,$next_page,$url,$mode,$meeting->meeting_id,$valueKey,$next_page_key,$qs);
                 $next_page=$t;
            }
            return redirect()->back()->with('success', $mode.'Updated successfully!');       

    }




   public static function createInstanceParticipant($meeting_id,$participant,$qs)
    {
        if(!Participant::where("instance_uuid",$qs["instance_uuid"])
                        ->where("meeting_id",$meeting_id)
                        ->where("user_id",$participant["user_id"])->exists())
        {
            $joinTime=Carbon::parse($participant["join_time"])->timezone('Africa/Nairobi');
            $leaveTime=Carbon::parse($participant["leave_time"])->timezone('Africa/Nairobi');
            Participant::create([
                                  'meeting_id'=>$meeting_id,
                                  'instance_uuid'=>$qs["instance_uuid"],
                                  'participant_id'=>$participant["id"],
                                  'user_id'=>$participant["user_id"], //unique for every entry in the participants table for every meeting
                                  'user_email'=>$participant["user_email"],
                                  'duration'=>$participant["duration"],
                                  'registrant_id'=>array_key_exists("registrant_id", $participant)?$participant["registrant_id"]:"",
                                  'name'=>array_key_exists("name", $participant)?$participant["name"]:"",
                                  'join_time'=>$joinTime,
                                  'leave_time'=>$leaveTime
                             ]);
        }




    }


   

    public function fetchInstanceParticipants(Request $request, Instance $instance)
    {
       ///report/meetings/{meetingId}/participants

         if (!strpos($instance->uuid, "/"))
            $uuid=$instance->uuid;
        else {
            $uuid=urlencode($instance->uuid);
            $uuid=urlencode($uuid);
        }

        $meeting=Meeting::firstWhere('meeting_id',$instance->meeting_id);
          
         $url="https://api.zoom.us/v2/report/meetings/".$uuid."/participants/?include_fields=registrant_id";
         $page_size=50;
         $mode='instanceParticipants';
         $valueKey=4;
         $qs=["instance_uuid"=>$instance->uuid];

          $next_page=""; 
          $next_page_key=3;
          if ($next_page=="")
                {
                     $t=Zoom::callZoom($request,$page_size,$next_page,$url,$mode,$meeting->meeting_id,$valueKey,$next_page_key,$qs);
                    $next_page=$t;
                }
            while ($next_page!="") 
            {
                $t=Zoom::callZoom($request,$page_size,$next_page,$url,$mode,$meeting->meeting_id,$valueKey,$next_page_key,$qs);
                 $next_page=$t;
            }
            return redirect()->back()->with('success', $mode.'Updated successfully!');   



    }


    public static function fetchInstanceParticipants2(Request $request, Instance $instance)
    {
       ///report/meetings/{meetingId}/participants

         if (!strpos($instance->uuid, "/"))
            $uuid=$instance->uuid;
        else {
            $uuid=urlencode($instance->uuid);
            $uuid=urlencode($uuid);
        }

        $meeting=Meeting::firstWhere('meeting_id',$instance->meeting_id);
          
         $url="https://api.zoom.us/v2/report/meetings/".$uuid."/participants/?include_fields=registrant_id";
         $page_size=50;
         $mode='instanceParticipants';
         $valueKey=4;
         $qs=["instance_uuid"=>$instance->uuid];

          $next_page=""; 
          $next_page_key=3;
          if ($next_page=="")
                {
                     $t=Zoom::callZoom($request,$page_size,$next_page,$url,$mode,$meeting->meeting_id,$valueKey,$next_page_key,$qs);
                    $next_page=$t;
                }
            while ($next_page!="") 
            {
                $t=Zoom::callZoom($request,$page_size,$next_page,$url,$mode,$meeting->meeting_id,$valueKey,$next_page_key,$qs);
                 $next_page=$t;
            }
           // return redirect()->back()->with('success', $mode.'Updated successfully!');   



    }



    public function export(Request $request,Instance $instance) 
    {
        $instance=Instance::find($request->instance_id);
       // dd($instance);
        $slug = Str::of(Carbon::now()->todateTimeString())->slug('_');  

           Excel::store(new InstanceExport($instance), $slug.'.xlsx');
             File::move(storage_path('app/'.$slug.'.xlsx'), public_path('reports/'.$slug.'.xlsx'));
        
             if ($request->session()->has('instance_xls'))
                  {
                    $request->session()->put('instance_xls', '/reports/'.$slug.'.xlsx');
                }
            else  $request->session()->push('instance_xls', '/reports/'.$slug.'.xlsx');

        return redirect()->back()->with('success','Data Exported Successfully!');
    }
   
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function show(Instance $instance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function index(Instance $instance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instance $instance)
    {
        //dd($request->all()); 
         $validated=$request->validate([
                                            //"uuid"=>['required'],
                                            //"meeting_id"=>['required'],
                                            //"start_time"=>['required'],
                                             "official_end_time"=>['required'],
                                             "official_start_time"=>['required']


 
                                                 ]);


         $instance->update([ 

                                            //"uuid"=>$request->uuid,
                                            "marked_for_grading"=>$request->marked_for_grading?1:0,
                                            //"meeting_id"=>$request->meeting_id,
                                            //"start_time"=>$request->start_time,
                                             "official_end_time"=>$request->official_end_time,
                                             "official_start_time"=>$request->official_start_time,
                                             //"grading_rule_id"=>$request->grading_rule_id



                                 ]);
        //InstanceController::fetchInstanceRecordings($request,$instance);

         return redirect()->back()->with('success',"Instance Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instance  $instance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instance $instance)
    {
        //
    }
}
