<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Registrant;
use App\Models\Participant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use App\Models\Setup;
use App\Models\ZoomUser;
use App\Models\Instance;
use App\Models\Occurrence;
use App\Http\Controllers\InstanceController;
use Illuminate\Support\Facades\DB;
use App\Zoom;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        return Inertia::render('Meetings/Index',[
                                 'filters' =>$request->all('search','trashed'),
                                 "url"=>"https://zoom.us/oauth/authorize?response_type=code&client_id=".$this->getSetup()->client_id."&redirect_uri=".$this->getSetup()->callback_url."&state={userState}",
                                 
                                "zmeetings"=>Meeting::where('meeting_type',2)->count(),
                                'meetings' => Meeting::with('registrants')
                                ->orderByDesc('start_time')
                                  ->filter($request->only('search', 'trashed'))
                                                     ->paginate(10)
                                                     ->withQueryString()
                                                     ->through(fn($meeting)=>([
                                                                                'id'=>$meeting->id,
                                                                                'meeting_id'=>$meeting->meeting_id,
                                                                                'meeting_type'=>$meeting->meeting_type,
                                                                                'guest_speaker'=>$meeting->guest_speaker,
                                                                                 'instances'=>$meeting->instances()->count(),
                                                                                 'occurrences'=>$meeting->occurrences()->count(),
                                                                                 'registrants'=>$meeting->registrants()->count(),
                                                                                 'participants'=>$meeting->participants()->count(),
                                                                                  'start_time'=>Carbon::parse($meeting->start_time)->toDateTimeString(),
                                                                                  'meeting_day'=>$meeting->meeting_day,
                                                                                  'topic'=>$meeting->topic
                                                                                    ]))
  
                                                ]);
    }
   


    public function filtered(Request $request)
    {
        //dd($request->all());
        
        // $searches=collect($request->all());

          $filteredMeetings=Meeting::filteredMeetings($request->all());
        return Inertia::render('Meetings/Index',[
                                 'filters' =>$request->all('search','trashed'),
                                "zmeetings"=>Meeting::where('meeting_type',2)->count(),
                                "url"=>"https://zoom.us/oauth/authorize?response_type=code&client_id=".$this->getSetup()->client_id."&redirect_uri=".$this->getSetup()->callback_url."&state={userState}",
                                'meetings' => Meeting::filteredMeetings($request->all())
                                                       ->with('registrants')
                                                       ->orderByDesc('start_time')
                                                     ->paginate(10)
                                                     ->withQueryString()
                                                     ->through(fn($meeting)=>([
                                                                                'id'=>$meeting->id,
                                                                                'meeting_id'=>$meeting->meeting_id,
                                                                                'meeting_type'=>$meeting->meeting_type,
                                                                                'guest_speaker'=>$meeting->guest_speaker,
                                                                                 'instances'=>$meeting->instances()->count(),
                                                                                 'occurrences'=>$meeting->occurrences()->count(),
                                                                                 'registrants'=>$meeting->registrants()->count(),
                                                                                 'participants'=>$meeting->participants()->count(),
                                                                                  'meeting_day'=>$meeting->meeting_day,
                                                                                 'start_time'=>Carbon::parse($meeting->start_time)->toDateTimeString(),
                                                                                'topic'=>$meeting->topic
                                                                                    ]))
  
                                                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
         $setup=Setup::firstWhere('current',true); 
        return Inertia::render('Meetings/Create',["last_meeting_no"=>$setup->last_meeting_no,"meeting_prefix"=>$setup->meeting_prefix]);
        //return Redirect::back()->with('error','this function is under construction');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $validated=$request->validate([

                                      "uuid"=>[],
                                      "meeting_id"=>['required',Rule::unique('meetings')],
                                      "start_time"=>['required'],
                                      "topic"=>['required'],
                                      "meeting_type"=>['required',Rule::in([1,2])]
                                      // 'email' => ['required', 'max:50', 'email', Rule::unique('members')]
                    ]);

            Meeting::create([
                       // "id"=>$request->id,
                              // "uuid"=>$request->uuid,
                              "meeting_id"=>$request->meeting_id,
                              "meeting_type"=>$request->meeting_type,
                              "topic"=>$request->topic,
                              "start_time"=>$request->start_time,
                              "timezone"=>'Africa/Nairobi',
                              "guest_speaker"=>$request->guest_speaker  

                             ]);

            Setup::firstWhere('current',true)->update(['last_meeting_no'=>preg_replace( '/[^0-9]/', '', $request->meeting_id )]);
           // return Redirect::route('members')->with('success', 'Member created.');
         return Redirect::route('meetings')->with('success','Meeting created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    
    public static function createZoomMeeting($item)
    {
        //$meeting_date=Carbon::parse($item["start_time"])->format('l');
         if(!Meeting::where("uuid",$item["uuid"])->exists() &&(array_key_exists("start_time", $item)))
                                        {
                                            //create
                                            Meeting::create([
                                                        "uuid"=>$item["uuid"],
                                                        "meeting_id"=>$item["id"],
                                                        "host_id"=>$item["host_id"],
                                                        "topic"=>$item["topic"],
                                                        "type"=>$item["type"],
                                                        "start_time"=>$item["start_time"],
                                                        "duration"=>$item["duration"],
                                                        "timezone"=>$item["timezone"],
                                                        "created_at"=>$item["created_at"],
                                                        "join_url"=>$item["join_url"],
                                                        "meeting_type"=>1,
                                                        "meeting_day"=>Carbon::parse($item["start_time"])->format('l')
                                               ]);
                                        }
    }



    public function getRegistrants(Request $request, Meeting $meeting)
    {
        
      
          



    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        

        
        // $instances=Instance::where("meeting_id",$meeting->meeting_id)->paginate(20);
        //      dd($instances);
             //dd($categories->toArray());
        
        return Inertia::render('Meetings/Edit',[
                                
                                      // "stats"=> [ $categories->toArray()],
                                      "registrantsStats"=> $meeting->registrantsStats(),
                                      "participantsStats"=> $meeting->participantsStats(),
                                       "instances"=>Instance::where("meeting_id",$meeting->meeting_id)
                                                              ->orderByDesc("start_time")
                                                              ->paginate(10)
                                                              ->through(fn($instance)=>([
                                                                                          "start_time"=>Carbon::parse($instance->start_time)->diffForHumans(),
                                                                                          "exact_time"=>Carbon::parse($instance->start_time)->toDayDateTimeString(),
                                                                                           "uuid"=>$instance->uuid,
                                                                                           "id"=>$instance->id,
                                                                                           "meeting_id"=>$instance->meeting_id,
                                                                                           // "registrants"=>Registrant::where('meeting_id',$instance->meeting_id)->count()
                                                                                            "participants"=>Participant::where('meeting_id',$instance->meeting_id)
                                                                                                                         ->where('instance_uuid',$instance->uuid)->count(),

                                                                                      ])),
                                        // "occurrences"=>Occurrence::where("meeting_id",$meeting->meeting_id)
                                        //                       ->orderByDesc("start_time")
                                        //                       ->paginate(10)
                                        //                       ->through(fn($occurrence)=>([
                                        //                                                   "start_time"=>Carbon::parse($occurrence->start_time)->toDateTimeString(),
                                        //                                                    "occurrence_id"=>$occurrence->occurrence_id,
                                        //                                                    "id"=>$occurrence->id,
                                        //                                                    "meeting_id"=>$occurrence->meeting_id,
                                        //                                                    "registrants"=>Registrant::where('meeting_id',$occurrence->meeting_id)
                                        //                                                                               ->where('occurrence_id',$occurrence->occurrence_id)->count()
                                        //                                               ])),
                                                    
                                      "meeting"=>[
                                                      
                                                     "id"=>$meeting->id,
                                                      "uuid"=>$meeting->uuid,
                                                      "meeting_id"=>$meeting->meeting_id,
                                                      "meeting_type"=>$meeting->meeting_type,
                                                      "guest_speaker"=>$meeting->guest_speaker,
                                                      "topic"=>$meeting->topic,
                                                      "start_time"=>Carbon::parse($meeting->start_time)->toDayDateTimeString(),
                                                      "instances"=>$meeting->instances()->count()
                                                      //"start_time"=>$meeting->start_time,
                                                    ]
                                            ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $meeting)
    {

           // dd($request);
           $validated=$request->validate([

                                      "uuid"=>['required'],
                                      "meeting_id"=>['required'],
                                      "start_time"=>['required'],
                                      "topic"=>['required'],
                                      "meeting_type"=>['required'],



           ]);
            $meeting->update([
                       // "id"=>$request->id,
                     "uuid"=>$request->uuid,
                      "meeting_id"=>$request->meeting_id,
                      "meeting_type"=>$request->meeting_type,
                      "topic"=>$request->topic,
                      "start_time"=>$request->start_time,
                      "timezone"=>'Africa/Nairobi'  

            ]);
         return Redirect::route('meetings')->with('success','Meeting updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('meetings')->with('success','Meeting Deleted Successfully');
    }




    public function getSetup()
    {
        $setup=Setup::where('current',true)
                      ->where('client_id','<>','')
                      ->where('client_secret','<>','')
                      ->where('callback_url','<>','')->get();
         
       $count=$setup->count();
       if (!$count=1) 
        {
            return redirect()->route('dashboard')->with('error', 'Your Zoom setup is incorrect'); 
        }

        return $setup[0];
          
    }

    public function show(Request $request)
    {
         $setup=$this->getSetup();
         
          $string=$setup->client_id.":".$setup->client_secret;
          $res=Http::withHeaders([    'Authorization'=>"Basic ".base64_encode($string),
                                        // 'Content-Type' => 'application/x-www-form-urlencoded'
                                              
                                            ])->asForm()->post('https://zoom.us/oauth/token',[

                                                'grant_type'   =>'authorization_code',
                                                'code'         =>$request->code,
                                                'redirect_uri' =>$setup->callback_url
                                             ]);

            $resp=$res->json();
            $token=collect($resp)->first();
            
            $this->token=$token;



            $request->session()->put('z_tk', $token);
            $request->session()->put('z_tk_time', Carbon::now());


             return redirect()->route('meetings')->with('success', 'Request authentication successful');
       }
            
       public function refreshUsers(Request $request)
       {    
             $token = Zoom::getToken($request);
            
           
            $ZoomUsers=Http::withToken($token)->get('https://api.zoom.us/v2/users');

            $obj=collect($ZoomUsers->json());
           // dd($obj);
            $ZoomUsers=collect($obj->values()[5]);
           
           $counter=$ZoomUsers->count() ;
          
           if ($counter<=0) 
             {
                return redirect()->route('meetings')->with('error', 'No users were found in your Zoom Account');
             }


            foreach ($ZoomUsers->toArray() as $key=>$user) 
            {
                  
                // return $user["pic_url"];

                  if (!ZoomUser::where('user_id',$user["id"])->exists())
                  {
                    ZoomUser::create([
                                        "user_id"=>$user["id"],
                                        "first_name"=>$user["first_name"],
                                        "last_name"=>$user["last_name"],
                                        "email"=>$user["email"],
                                        "type"=>$user["type"],
                                        "pmi"=>$user["pmi"],
                                        "dept"=>$user["dept"],
                                        "created_at"=>$user["created_at"],
                                        "last_login_time"=>$user["last_login_time"],
                                        //"pic_url"=>$user["pic_url"],
                                        "phone_number"=>$user["phone_number"],
                                        "status"=>$user["status"],
                                        "role_id"=>$user["role_id"]

                                      ]);
                  
                  }
                  else
                  {
                    
                     $zoomUser=ZoomUser::firstWhere('user_id',$user["id"]);
                     $zoomUser->update([
                                        "first_name"=>$user["first_name"],
                                        "last_name"=>$user["last_name"],
                                        "email"=>$user["email"],
                                        "type"=>$user["type"],
                                        "pmi"=>$user["pmi"],
                                        "dept"=>$user["dept"],
                                        "created_at"=>$user["created_at"],
                                        "last_login_time"=>$user["last_login_time"],
                                       // "pic_url"=>$user["pic_url"],
                                        "phone_number"=>$user["phone_number"],
                                        "status"=>$user["status"],
                                        "role_id"=>$user["role_id"]

                                      ]);
                  }

                  
            }
             return redirect()->route('meetings')->with('success', 'Zoom User List updated successfully');
           
    }


    public function fetchParticipants()

    {
        //this function will attempt to get participants for all the meetings
        foreach (Meeting::all() as $meeting) 
        {
            if ($meeting->participants()->count()==0){
                $this->fetchMeetingParticipants($meeting);
            }
        }

    }


    public function fetchRegistrants()

    {
        //this function will attempt to get registrants for all the meetings
        foreach (Meeting::all() as $meeting) 
        {
            if ($meeting->registrants()->count()==0){
                $this->fetchMeetingRegistrants($meeting);
            }
        }

    }


    public function fetchMeetingRegistrants(Request $request, Meeting $meeting)
    {
         $url="https://api.zoom.us/v2/meetings/".$meeting->meeting_id."/registrants";
         $page_size=50;
         $mode='registrants';
         $valueKey=3;
          $next_page=""; 
          $next_page_key=2;
          $qs=[];
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

    public function fetchMeetingParticipants(Request $request, Meeting $meeting)
    {

         /// "https://api.zoom.us/v2/report/meetings/".$meeting->meeting_id."/participants"
         $url="https://api.zoom.us/v2/report/meetings/".$meeting->meeting_id."/participants?include_fields=registrant_id";
         $page_size=50;
         $mode='participants';
          $next_page=""; 
          $valueKey=4;
          $next_page_key=3;
          $qs=[];
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


    


    
   




    public function meetings(Request $request)
    {
         /*
           {
              "type": "object",
              "properties": {
                "occurrence_id": {
                  "type": "string",
                  "description": "Meeting Occurrence ID. Provide this field to view meeting details of a particular occurrence of the [recurring meeting](https://support.zoom.us/hc/en-us/articles/214973206-Scheduling-Recurring-Meetings)."
                },
                "show_previous_occurrences": {
                  "type": "boolean",
                  "description": "Set the value of this field to `true` if you would like to view meeting details of all previous occurrences of a [recurring meeting](https://support.zoom.us/hc/en-us/articles/214973206-Scheduling-Recurring-Meetings). "
                }
              },
              "required": []
            }

         */
       
         $page_size=50;
         $mode='meetings';
         $valueKey=3;
         $next_page_key=2;

         $z_users= ZoomUser::all();
         if ($z_users->count()<=0) 
             {
                return redirect()->route('meetings')->with('error', 'No users were found in your Zoom account, please reload zoom users');
             }
         $next_page=""; 
         $qs=[];
        
            foreach ($z_users as $user)
            {  
                  $url='https://api.zoom.us/v2/users/'.$user->user_id.'/meetings?type=scheduled';
           //first time
                   if ($next_page=="")
                    {
                         $t=Zoom::callZoom($request,$page_size,$next_page,$url,$mode,'',$valueKey,$next_page_key,$qs);
                         $next_page=$t;
                    }
                   while ($next_page!="") 
                    {
                        $t=Zoom::callZoom($request,$page_size,$next_page,$url,$mode,'',$valueKey,$next_page_key,$qs);
                         $next_page=$t;
                    }
                
                //after being done with one user
                $next_page="";
                   
             }
            





                     
             return redirect()->back()->with('success', $mode,' Updated successfully!');       

    
   }


     public function fetchMeetingInstances(Request $request, Meeting $meeting)
     {
          ///past_meetings/{meetingId}/instances
        //
         $url="https://api.zoom.us/v2/past_meetings/".$meeting->meeting_id."/instances";
         $token = Zoom::getToken($request);
         $instances=Http::withToken($token)->get($url);
         $mode="instances";

            $obj=collect($instances->json());
         
            if (!array_key_exists("meetings",$obj->toArray()))
                 return redirect()->back()->with('error',$mode.'No instances were found for that meeting');

              $instances=$obj ["meetings"];
              //dd($instances);
            
            foreach ($obj ["meetings"] as $instance) 
            {  
                if (!Instance::where('uuid',$instance["uuid"])->exists())
                  {
                     if(array_key_exists("start_time",$instance)) 
                        {
                            $st=Carbon::parse($instance["start_time"]);
                    
                           $i=Instance::create([
                                        "meeting_id"=>$meeting->meeting_id,
                                        "uuid"=>$instance["uuid"],
                                        "start_time"=>$st,
                                      ]);
                             
                           InstanceController::fetchInstanceRecordings($request,$i);
                           InstanceController::fetchInstanceParticipants2($request,$i);
                      }
                  }
         
            }

        return redirect()->back()->with('succecss',$mode.'imported Successfuly');
    }





     public function fetchMeetingOccurrences(Request $request, Meeting $meeting)
     {
          ///past_meetings/{meetingId}/instances
        //
         $url="https://api.zoom.us/v2/meetings/".$meeting->meeting_id."?show_previous_occurrences=true";
         $token = Zoom::getToken($request);
         $instances=Http::withToken($token)->get($url);
         $mode="occurrences";

            $obj=collect($instances->json());

            //dd($obj["occurrences"]);
         
            // if (!array_key_exists("meetings",$obj->toArray()))
            //      return redirect()->back()->with('error',$mode.'No instance were found for that meeting');

            //   $instances=$obj ["meetings"];
            //   //dd($instances);
            
            foreach ($obj ["occurrences"] as $occurrence) 
            {  
                if (!Occurrence::where('occurrence_id',$occurrence["occurrence_id"])
                               ->where('meeting_id',$meeting->meeting_id)->exists())
                  {
                     if(array_key_exists("start_time",$occurrence)) 
                        {
                            $st=Carbon::parse($occurrence["start_time"]);
                    
                           Occurrence::create([
                                        "meeting_id"=>$meeting->meeting_id,
                                        "occurrence_id"=>$occurrence["occurrence_id"],
                                        "duration"=>$occurrence["duration"],
                                        "start_time"=>$st,
                                      ]);
                      }
                  }
         
            }

        return redirect()->back()->with('succecss',$mode.'imported Successfuly');
    }

}
