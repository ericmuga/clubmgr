<?php

namespace App\Http\Controllers;

use App\Models\Occurrence;
use Illuminate\Http\Request;
use App\Models\Instance;
use App\Models\Meeting;
use Carbon\Carbon;
use App\Zoom;
use App\Models\Registrant;

class OccurrenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
   public static function createOccurrenceRegistrant($meeting_id,$registrant,$qs)
    {
        if(!Registrant::where("email",$registrant["email"])
                        ->where("occurrence_id",$qs["occurrence_id"])
                        ->where("meeting_id",$meeting_id)->exists())
        {
            $createTime=Carbon::parse($registrant["create_time"])->timezone('Africa/Nairobi');
            Registrant::create([
                                  'meeting_id'=>$meeting_id,
                                  'occurrence_id'=>$qs["occurrence_id"],
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


 public function fetchOccurrenceRegistrants(Request $request, Occurrence $occurrence)
    {
         $meeting=Meeting::firstWhere('meeting_id',$occurrence->meeting_id);
          
         $url="https://api.zoom.us/v2/meetings/".$meeting->meeting_id."/registrants?occurrence_id=".$occurrence->occurrence_id;
         $page_size=50;
         $mode='occurrenceRegistrants';
         $valueKey=3;
         $qs=["occurrence_id"=>$occurrence->occurrence_id];

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



    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     * @param  \App\Models\Occurrence  $occurrence
     * @return \Illuminate\Http\Response
     */
    public function show(Occurrence $occurrence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Occurrence  $occurrence
     * @return \Illuminate\Http\Response
     */
    public function edit(Occurrence $occurrence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Occurrence  $occurrence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occurrence $occurrence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Occurrence  $occurrence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occurrence $occurrence)
    {
        //
    }
}
