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
use Carbon\Carbon;
// use App\Models\Instance;

class DashboardController extends Controller
{
    public $token='';
     
    public function index()
    {

          //prefetch zoom users in case of changes
        
          
          $setup=$this->getSetup();

          

          return Inertia::render('Dashboard/Index',[ "client_id"=>$setup->client_id,
                                                     "callback_url"=>$setup->callback_url,
                                                     'meetings'=>[
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
                                                                                        // ->whereYear('official_end_time',now()->year)
                                                                                        ->get()->pluck('D')->toArray()
                                                                   ],
                                                      'members'=>[ 'count'=>DB::table('members')->count(),
                                                                   'title'=>'Members',
                                                                   'asAt'=>Carbon::parse(DB::table('instances')
                                                                                  ->orderByDesc('start_time')->get()->first()->start_time)->diffForHumans()
                                                                ],
                                                      'promotions'=>[
                                                                      'title'=>'Due for induction',
                                                                      'count'=>8,
                                                                      'thisMonth'=>6,
                                                                   ],

                                                      'guests'=>[  'title'=>'guests',
                                                                    'count'=>DB::table('registrants')
                                                                                ->join('members','registrants.email','=','members.email','left')
                                                                                ->where('members.email',null)
                                                                                ->count()
                                                                
                                                                 ]

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


