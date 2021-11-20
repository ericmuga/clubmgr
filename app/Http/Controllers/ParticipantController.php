<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Meeting;
use App\Models\Instance;
use App\Models\Registrant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\GradingRule;
use App\Models\GradingHistory;
use Illuminate\Support\Facades\Redirect;
use App\Exports\ParticipantsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use File;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     * 
     */


    public function filteredParticipants(Request $request)
    {
    //  dd($request->all()); 
              $request->validate([
                                  '_from'=>['required'],
                                  '_to'=>['required']
                                //   'gradingrule_id'=>['required']
                               ]);
            
            $slug = Str::of(Carbon::now()->todateTimeString())->slug('-');     
       
            Excel::store(new ParticipantsExport($request->all()), $slug.'.xlsx');
            Schema::dropIfExists('temp');

            GradingHistory::create([
                                    'user_id'=>$request->user()->email,
                                    'from'=>$request->_from,
                                    'to'=>$request->_to,
                                    'grading_rule_id'=>$request->gradingrule_id,
                                    'meeting_id'=>'',
                                    'category'=>($request->category==null)?'':$request->category,
                                    'downloadurl'=>$slug.'.xlsx'
                                    ]);  
            //    rename('/storage/app/'.$slug.'.xlsx', '/public/'.$slug);
             File::move(storage_path('app/'.$slug.'.xlsx'), public_path('reports/'.$slug.'.xlsx'));
            
            return redirect()->back()->with('success','download successful');
            
         //commit to history gradings
         /*
           $table->id();
            $table->string('user_id');
            $table->dateTime('from');
            $table->dateTime('to');
            $table->string('meeting_id');
            $table->string('category');
            $table->string('grading_rule_id');
            $table->timestamps();
         */
        
         
    }


    public function index(Request $request)
    {

        // dd($request->all());

        // /dd(Meeting::find(Participant::first()->load('meeting')->meeting_id));
        return Inertia::render('Participants/Index',[
                                'filters' =>$request->all('search','trashed'),
                                'participants' => Participant::orderBy('name')
                                ->filter($request->only('search', 'trashed'))
                                                     ->paginate(10)
                                                     ->withQueryString()
                                                     ->through(fn($participant)=>([
                                                        'id'=>$participant->id,
                                                        'name'=>$participant->name,
                                                        'email'=>$participant->user_email,
                                                        'join_time'=>Carbon::parse($participant->join_time)->toDateTimeString(),
                                                        'leave_time'=>Carbon::parse($participant->leave_time)->toDateTimeString(),
                                                        // 'duration'=>$participant->join_time->diffInMinutes($participant->leave_time),
                                                        'meeting_id'=>$participant->meeting_id,
                                                        'instance_uuid'=>$participant->instance_uuid,
                                                        //'instance_start_time'=>DB::table('instances')->where("uuid",$participant->instance_uuid)->exists()?((Instance::firstWhere("uuid",$participant->instance_uuid)->official_start_time)!=null)->toDateTimeString():"",
                                                        //'instance_end_time'=>DB::table('instances')->where("uuid",$participant->instance_uuid)->exists()?Instance::firstWhere("uuid",$participant->instance_uuid)->official_end_time->toDateTimeString():"",
                                                        'mid'=>Meeting::where('meeting_id',$participant->meeting_id)->first()->id,
                                                        'start_time'=>Carbon::parse(Meeting::where('meeting_id',$participant->meeting_id)->first()->start_time)->toDateTimeString(),
                                                        'timeCredit'=>$participant->timeCredit(),
                                                        "category"=>(Registrant::where('email',$participant->user_email)->first())?Registrant::where('email',$participant->user_email)->first()->category:"",
                                                        "club_name"=>(Registrant::where('email',$participant->user_email)->first())?Registrant::where('email',$participant->user_email)->first()->club_name:"",
                                                       
                                                     ])),
                                'gradingrules'=>GradingRule::orderBy('rule_name')
                                                            ->paginate(10)
                                                            ->through(fn($gradingrule)=>(
                                                                [
                                                                    'id'=>$gradingrule->id,
                                                                    'rule_name'=>$gradingrule->rule_name,
                                                                    'meeting_type'=>$gradingrule->meeting_type
                                                                ]
                                                            ))


        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     * 
    */

   public static function createZoomParticipant($meeting_id,$participant)
    {  
        $joinTime=Carbon::parse($participant["join_time"])->timezone('Africa/Nairobi');
        $leaveTime=Carbon::parse($participant["leave_time"])->timezone('Africa/Nairobi');
        $duration=$joinTime->diffInMinutes($leaveTime,true);
            
        if(!Participant::where("user_id",$participant["user_id"])->exists())
        {
            Participant::create([
                                  'meeting_id'=>$meeting_id,
                                  'user_id'=>array_key_exists("user_id", $participant)?$participant["user_id"]:"",
                                  'participant_id'=>array_key_exists("id", $participant)?$participant["id"]:"",
                                  'registrant_id'=>array_key_exists("registrant_id", $participant)?$participant["registrant_id"]:"",
                                  'user_email'=>array_key_exists($participant["user_email"],$participant)?$participant["user_email"]:"",
                                  'name'=>array_key_exists("name", $participant)?$participant["name"]:"",
                                  'join_time'=>$joinTime,
                                  'leave_time'=>$leaveTime,
                                  //'duration'=>$participant["duration"]
                                  'duration'=>$duration
                             ]);
        }




    }


    public function fetchParticipants()

    {
       //logic, this will fetch participants for a given range of meetings.

       /*
           Display meeting dates, start and end
           filter this meetings and get the meeting ID
           for each meeting, fetch participants
       */

    }

    public function create()
    {
        return Redirect::back()->with('error','this function is under construction');
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
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        //
    }
}
