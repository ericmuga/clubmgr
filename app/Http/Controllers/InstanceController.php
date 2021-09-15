<?php

namespace App\Http\Controllers;

use App\Models\Instance;
use App\Models\Meeting;
use App\Models\Participant;
use Carbon\Carbon;
use App\Zoom;
use Illuminate\Http\Request;

class InstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

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
    public function edit(Instance $instance)
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
        //
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
