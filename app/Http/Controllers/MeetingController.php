<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Registrant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use App\Models\Setup;
use App\Models\ZoomUser;

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
                                "zmeetings"=>Meeting::where('meeting_type','Zoom')->count(),
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
                                                                                 'registrants'=>$meeting->registrants()->count(),
                                                                                 'participants'=>$meeting->participants()->count(),
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

            Setup::firstWhere('current',true)->update(['last_meeting_no'=>$request->meeting_id]);
           // return Redirect::route('members')->with('success', 'Member created.');
         return Redirect::route('meetings')->with('success','Meeting created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function getRegistrants(Request $request)
    {
        
        //fetch from zoom
          



    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        
        return Inertia::render('Meetings/Edit',[
                                
                                      "meeting"=>[
                                                      "id"=>$meeting->id,
                                                      "uuid"=>$meeting->uuid,
                                                      "meeting_id"=>$meeting->meeting_id,
                                                      "meeting_type"=>$meeting->meeting_type,
                                                      "topic"=>$meeting->topic,
                                                      "start_time"=>Carbon::parse($meeting->start_time)->toDayDateTimeString(),
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


             return redirect()->route('meetings')->with('success', 'Request authentication successful');
       }
            
       public function refreshUsers(Request $request)
       {    
             $token = $request->session()->get('z_tk');
            
           
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
             return redirect()->route('dashboard')->with('success', 'Zoom User List updated successfully');
           
    }

    public function fetchUserMeetings($user,$page_meetings,$next,$token)
    {
         //$page_size=10;
                   if($next=="")
                       $meetings=Http::withToken($token)
                                  ->get('https://api.zoom.us/v2/users/'.$user->user_id.'/meetings',['type'=>'scheduled','page_size'=>$page_meetings]);
                   else
                    $meetings=Http::withToken($token)
                                  ->get('https://api.zoom.us/v2/users/'.$user->user_id.'/meetings',
                                                       ['type'=>'scheduled',
                                                        'page_size'=>$page_meetings,'next_page_token'=>$next]);

                                                                                       
                   $obj=collect($meetings->json());
                  // dd($obj);
                    //meetings within the API call
                    if (collect($obj->values()[3])->count()<=0) 
                    return "";

                   $next_page=collect($obj->values()[2])->first();
                   
                    $api_meetings=collect($obj->values()[3]);
                    foreach ($api_meetings as  $meeting) 
                    {
                        if(!Meeting::where("uuid",$meeting["uuid"])->exists() &&(array_key_exists("start_time", $meeting)))
                        {
                            //create
                            Meeting::create([
                                     "uuid"=>$meeting["uuid"],
                                        "meeting_id"=>$meeting["id"],
                                        "host_id"=>$meeting["host_id"],
                                        "topic"=>$meeting["topic"],
                                        "type"=>$meeting["type"],
                                    "start_time"=>$meeting["start_time"],
                                        "duration"=>$meeting["duration"],
                                        "timezone"=>$meeting["timezone"],
                                        "created_at"=>$meeting["created_at"],
                                        "join_url"=>$meeting["join_url"],
                                        "meeting_type"=>2
                               ]);
                        }
                    }
                    return $next_page;

    }


    public function meetings(Request $request)
    {
         
        $token = $request->session()->get('z_tk');
        if ($token='') return redirect()->route('meetings')->with('error','Request not authorized, please log in to zoom');

        $z_users= ZoomUser::all();
        
         if ($z_users->count()<=0) 
             {
                return redirect()->route('meetings')->with('error', 'No users were found in your Zoom account, please reload zoom users');
             }


        $next_page=""; 
        
        foreach ($z_users as $user)
        {  
                //first time
               if ($next_page=="")
                {
                     $t=$this->fetchUserMeetings($user,30,$next_page,$token);
                     $next_page=$t;
                }
               while ($next_page!="") 
                {
                    $t=$this->fetchUserMeetings($user,30,$next_page,$token);
                     $next_page=$t;
                }
            
            //after being done with one user
            $next_page="";
               
        }
                 
         return redirect()->back()->with('success', 'Meetings Updated successfully!');       

    
   }
}
