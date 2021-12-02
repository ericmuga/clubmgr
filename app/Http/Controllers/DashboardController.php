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
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ZoomUser;
use App\Models\Meeting;
use App\Models\Member;
use App\Models\MemberContacts;
use App\Models\Instance;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Exports\MainCollectionExporter;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use File;
use App\Exports\InstancesExport;



class DashboardController extends Controller 
{
     public $token='';
     // public function sheets(): array
     //    {
     //        $sheets = [];

     //        for ($month = 1; $month <= 12; $month++) {
     //            $sheets[] = '';//new InvoicesPerMonthSheet($this->year, $month);
     //        }

     //        return $sheets;
     //    }


    public static function pivotCollection(Request $request,$collection,$uniqeIdColumn,$spreadColumn)
    {
        
       

         $year_month=collect($collection->sortBy('instance_y_m')->pluck('instance_year_month')->unique()->flatten());  
         $slug = Str::of(Carbon::now()->todateTimeString())->slug('_');  
         Excel::store(new InstancesExport($collection,$year_month,$uniqeIdColumn,$spreadColumn), $slug.'.xlsx');
         File::move(storage_path('app/'.$slug.'.xlsx'), public_path('reports/'.$slug.'.xlsx'));

             if ($request->session()->has('instances_xls'))
                  {
                    $request->session()->put('instances_xls', '/reports/'.$slug.'.xlsx');
                }
            else  $request->session()->push('instances_xls', '/reports/'.$slug.'.xlsx');
         
         return redirect()->back()->with('success','List Exported Successfully');
            
     }

    public static function getAttendanceByMonth(Request $request)
    {
        /*

            get instances within date range grouped by year-month 
            
            grade participants in instances
            foreach month, create new sheet, 
            spread instance dates and grade all participants

        */
            $request->validate([ 'startDate'=>'required',
                                 'endDate'=>'required'



                         ]);
           // if(!($request->has('startDate')&&$request->has('endDate'))) return redirect()->back()->with('error','Please fill in the start and end dates');

            $instancesGroupedByMonth=DashboardController::getInstancesInDateRange($request->startDate,$request->endDate);

            $participantsInInstances=DashboardController::getParticipantsInInstacnces($instancesGroupedByMonth->pluck('uuid'));
           
            $participantsAttended=collect([]);
            foreach ($participantsInInstances as $key => $p) 
            {
              if($p->memberId()=='') DashboardController::addParticipantToMembers($p);
              $member_id=$p->memberId();
              if ($member_id!='') 

                      {$participantsAttended->push([ 'name'=>$p->name,
                                                    'email'=>$p->user_email,
                                                    'member_id'=>$member_id,
                                                    'instance_uuid'=>$p->instance_uuid,
                                                    'instance_date'=>$instancesGroupedByMonth->where('uuid',$p->instance_uuid)->first()->date,
                                                    'instance_year_month'=>$instancesGroupedByMonth->where('uuid',$p->instance_uuid)->first()->year.'-'.$instancesGroupedByMonth->where('uuid',$p->instance_uuid)->first()->month,
                                                    'instance_y_m'=>$instancesGroupedByMonth->where('uuid',$p->instance_uuid)->first()->year+$instancesGroupedByMonth->where('uuid',$p->instance_uuid)->first()->month,
                                                    'score'=>Member::find($member_id)->instanceAttended($p->instance_uuid)

                                                  ]);
                    }
                    
            }

           return DashboardController::pivotCollection($request,$participantsAttended,'member_id','instance_date');


    }

    public static function addParticipantToMembers($participant)
    {
        //['name','affiliation_id','type_id','active','phone','sector','gender'];  
         $affiliation=3;$sector='';
        if($participant->registrant()->exists())
        {
            $registrant=$participant->registrant()->first();
            switch ($registrant->category) 
            {
                case 'Rotarian':$affiliation=1; break;
                case 'RTN':$affiliation=1; break;
                case 'Rotaractor':$affiliation=2; break;
                case 'RCT':$affiliation=2; break;
                case 'RCT':$affiliation=2; break;
                default:$affiliation=3; break;
            }

            $sector=$registrant->classification;

        }

        $member=Member::create([ 'name'=>$participant->name,
                                 'affiliation_id'=>$affiliation,
                                 'type_id'=>3,
                                 'active'=>true,
                                 'sector'=>$sector,
                                 'gender'=>''

                               ]);

        if($participant->user_email!='') MemberContacts::create(['member_id'=>$member->id,'contact'=>$participant->user_email,'contact_type'=>'email']);




    }


    public static function getInstancesInDateRange($startDate,$endDate)
    {
       //dd('here');
       return DB::table('instances')
             ->selectRaw('uuid, DATE(official_start_time) date, YEAR(official_start_time) year, MONTH(official_start_time) month')
             ->where('official_start_time','>=',$startDate)
             ->where('official_start_time','<=',$endDate)
             ->where('marked_for_grading',true)
             ->groupBy('uuid','date', 'year','month')
             ->orderBy('year','ASC')
             ->orderBy('month','ASC')
             ->orderBy('date','ASC')
             ->get();

    }

    public static function getParticipantsInInstacnces($instances)
    {
        //dd($instances);
        return Participant::whereIn('instance_uuid',$instances)->get();
    }

    public static function getProspectiveInductees(Request $request)
    {
       $guestList=Member::where('type_id',3)
                         ->select('id')
                        ->whereHas('member_contacts',
                                       fn($q)=>($q->where('contact_type','=','email')
                                                  ->whereHas('participants',fn($query)=>($query->whereHas('instance',
                                                                                                             fn($qr)=>($qr->where('marked_for_grading','=',true)))))))->get();
       //$guestList->pluck('id')->toArray());
     
       $fineList=DB::table('member_contacts')
               ->select('member_id','instance_uuid','instances.official_start_time')
               ->join('participants','participants.user_email','=','member_contacts.contact')
               ->join('instances','instances.uuid','=','instance_uuid')
               ->where('instances.marked_for_grading',true)
               ->where('instances.official_start_time','<>',null)
               ->where('contact_type','email')
               ->whereIn('member_id',$guestList)
               ->groupBy('member_id','instance_uuid','official_start_time')
               ->orderBy('member_id','ASC')
               ->orderBy('instances.official_start_time','ASC')
               ->get();

        $sixthMeeting=collect([]);                   
        
        $memberScore=0;
        $prev=0;
        foreach ($fineList as $item) 
        {   
             
             $member=Member::find($item->member_id);
             $email=MemberContacts::where('member_id',$member->id)
                                  ->where('contact_type','email')
                                  ->first()->contact;
             if($prev==$item->member_id) $memberScore+=$member->instanceAttended($item->instance_uuid);
             else $memberScore=Member::find($item->member_id)->instanceAttended($item->instance_uuid);
                   
             if($memberScore==6)
               if(!$sixthMeeting->contains('email',$email)) 
                {  
                    $sixthMeeting->push(['name'=>$member->name,
                                        'email'=>$email,
                                         'sixthMeeting'=>Carbon::parse($item->official_start_time)->toDateString()
                                        ]);
                }
                 
            $prev=$item->member_id;
        }
      
        $headings=[
                    ['REPORT'=>"REPORT",'REPORT'=>'PROSPECTIVE INDUCTEES'],
                    [],
                    ['NAME'=>"NAME",'EMAIL'=>"EMAIL",'SIXTH MEETING'=>'SIXTH MEETING']

                  ];
        $sixthMeeting->prepend($headings);

         
       // dd($instance);
        $slug = Str::of(Carbon::now()->todateTimeString())->slug('_');  

           Excel::store(new MainCollectionExporter($sixthMeeting), $slug.'.xlsx');
             File::move(storage_path('app/'.$slug.'.xlsx'), public_path('reports/'.$slug.'.xlsx'));
        
             if ($request->session()->has('inductees_xls'))
                  {
                    $request->session()->put('inductees_xls', '/reports/'.$slug.'.xlsx');
                }
            else  $request->session()->push('inductees_xls', '/reports/'.$slug.'.xlsx');

        return redirect()->back()->with('success','Data Exported Successfully!');
       


    }


    
     
    public function index(Request $request)
    {

          //prefetch zoom users in case of changes
        
          
          $setup=$this->getSetup();

          $memberEmails=DB::table('members')
                          ->selectRaw('member_contacts.contact')
                          ->join('member_contacts','members.id','=','member_contacts.member_id')
                          ->where('member_contacts.contact_type','=','email')
                          ->where('members.type_id',1);


        
       
          return Inertia::render('Dashboard/Index',[ "client_id"=>$setup->client_id,
                                                     "callback_url"=>$setup->callback_url,
                                                     'meetings'=>[   'xlxs'=>$request->session()->get('inductees_xls',''),
                                                                     'instances'=>$request->session()->get('instances_xls',''),
                                                                   'count'=>DB::table('instances')->where('marked_for_grading',true)->count(),
                                                                   'title'=>'Gradable Meetings',
                                                                    'thisMonth'=> DB::table('instances')
                                                                                    ->whereMonth('official_end_time',now()->month)
                                                                                     ->whereYear('official_end_time',now()->year)
                                                                                    ->count(),
                                                                     'thisMonthDates'=>DB::table('instances')
                                                                                        ->selectRaw('DATE(official_end_time) as D')
                                                                                        ->groupByRaw('official_end_time')
                                                                                        ->orderByRaw('D')
                                                                                        ->whereMonth('official_end_time',now()->month)
                                                                                        ->whereYear('official_end_time',now()->year)
                                                                                        ->get()->pluck('D')->toArray(),

                                                                    'thisMonthGuests'=>DB::table('instances')
                                                                                        ->selectRaw('DATE(instances.official_end_time) as D,COUNT(distinct participants.user_email)as C')
                                                                                        ->join('participants','participants.instance_uuid','instances.uuid')
                                                                                        ->whereNotIn('participants.user_email',$memberEmails)
                                                                                        ->groupByRaw('instances.official_end_time')
                                                                                        ->orderByRaw('C')
                                                                                        ->whereMonth('instances.official_end_time',now()->month)
                                                                                        ->whereYear('instances.official_end_time',now()->year)
                                                                                        ->get()->pluck('C')->toArray(),
                                                                     'thisMonthMembers'=>DB::table('instances')
                                                                                        ->selectRaw('DATE(instances.official_end_time) as D,COUNT(distinct participants.user_email)as C')
                                                                                        ->join('participants','participants.instance_uuid','instances.uuid')
                                                                                        ->whereIn('participants.user_email',$memberEmails)
                                                                                        ->groupByRaw('instances.official_end_time')
                                                                                        ->orderByRaw('C')
                                                                                        ->whereMonth('instances.official_end_time',now()->month)
                                                                                        ->whereYear('instances.official_end_time',now()->year)
                                                                                        ->get()->pluck('C')->toArray(),
                                                                   ],
                                                      'members'=>[ 'count'=>DB::table('members')
                                                                                ->where('type_id',1)
                                                                                ->count(),
                                                                   'title'=>'Members',
                                                                   'asAt'=>Carbon::parse(DB::table('instances')
                                                                                  ->orderByDesc('start_time')->get()->first()->start_time)->diffForHumans()
                                                                ],
                                                      // 'promotions'=>[
                                                      //                 'title'=>'Due for induction',
                                                      //                 'count'=>$this->getProspectiveInductees()->count(),
                                                      //                 'thisMonth'=>6,
                                                      //              ],
                                                           

                                                      'guests'=>[  
                                                                    'title'=>'guests',
                                                                    'count'=>DB::table('registrants')
                                                                               ->whereNotIn('registrants.email',$memberEmails)->count()
                                                                                                            
                                                                 ]

                                                    ]);

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


