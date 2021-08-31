<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Http\Request;
//use Redirect;
use App\Models\Setup;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

use App\Models\ZoomUser;
use App\Models\Meeting;
class DashboardController extends Controller
{
    public $token='';
     
    public function index()
    {

          //prefetch zoom users in case of changes
        
          
          $setup=$this->getSetup();

          

          return Inertia::render('Dashboard/Index',[ "client_id"=>$setup->client_id,
                                                     "callback_url"=>$setup->callback_url

                                                    ]);

         // <a href="https://zoom.us/oauth/authorize?response_type=code&client_id=88qbzpueTkGI66J9dKWd1g&redirect_uri=https://localhost/show&state={userState}">Check Meetings</a>

//            $setup=$this->getSetup();
//            $url= 'https://zoom.us/oauth/authorize?response_type=code&client_id='.$setup->client_id.'&redirect_uri=https://localhost/&state={userState}';
// //'.$setup->callback_url.'
//            //dd($url);

//          return Http::get($url);

        //dd($resonse);
         // return Http::dd()->get('https://zoom.us/oauth/authorize?response_type=code&client_id=88qbzpueTkGI66J9dKWd1g&redirect_uri=https://localhost/show&state={userState}');

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


             return redirect()->route('dashboard')->with('success', 'Request authentication successful');
       }
            
       public function refreshUsers(Request $request)
       {    
             $token = $request->session()->get('z_tk');
            
           
            $ZoomUsers=Http::withToken($token)->get('https://api.zoom.us/v2/users');

            $obj=collect($ZoomUsers->json());
            $ZoomUsers=collect($obj->values()[5]);
           
           $counter=$ZoomUsers->count() ;
          
           if ($counter<=0) 
             {
                return redirect()->route('dashboard')->with('error', 'No users were found in your Zoom Account');
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

                   if($next=="")
                       $meetings=Http::withToken($token)
                                  ->get('https://api.zoom.us/v2/users/'.$user->user_id.'/meetings',['type'=>'scheduled','page_size'=>3]);
                   else
                    $meetings=Http::withToken($token)
                                  ->get('https://api.zoom.us/v2/users/'.$user->user_id.'/meetings',
                                                       ['type'=>'scheduled',
                                                        'page_size'=>3,'next_page_token'=>$next]);

                                                                                       
                   $obj=collect($meetings->json());
                   
                    //meetings within the API call
                    if (collect($obj->values()[3])->count()<=0) 
                    return "";

                   $next_page=collect($obj->values()[2])->first();
                   
                    $api_meetings=collect($obj->values()[3]);
                    foreach ($api_meetings as  $meeting) 
                    {
                        if(!Meeting::where("uuid",$meeting["uuid"])->exists())
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
                                        "meeting_type"=>"Zoom"
                               ]);
                        }
                    }
                    return $next_page;

    }


    public function meetings(Request $request)
    {
         
        $token = $request->session()->get('z_tk');
        $z_users= ZoomUser::all();
        
         if ($z_users->count()<=0) 
             {
                return redirect()->route('dashboard')->with('error', 'No users were found in your Zoom Account');
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

    public function participants(Request $request)
    {
        //get participants of meetings

        ///v2/accounts/{accountId}/report/meetings/{meetingID}/participants

        ///metrics/meetings/{meetingId}/participants
        $meeting=Meeting::first();
        $token = $request->session()->get('z_tk');

        return Http::withToken($token)
                     ->get('https://api.zoom.us/v2/report/meetings/'.$meeting->id.'/participants');

    }

}


