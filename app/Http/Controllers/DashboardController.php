<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Redirect;

class DashboardController extends Controller
{
    public function index()
    {

        //Make Zooom Requests
        //request authorization
        //'name' => env('APP_NAME', 'ClubMgr'),

       // https://zoom.us/oauth/authorize?response_type=code&client_id=7lstjK9NTyett_oeXtFiEQ&redirect_uri=https://localhost/show&state={userState}
           // $url='https://zoom.us/oauth/authorize?response_type=code&client_id='.env('ZOOM_CLIENT_ID','').'&redirect_uri='.env('ZOOM_CALLBACK','').'&state={userState}';

          return Inertia::render('Dashboard/Index');

         

        // Http::get('https://zoom.us/oauth/authorize?response_type=code&client_id=88qbzpueTkGI66J9dKWd1g&redirect_uri=https://localhost/show&state={userState}');
         // return Http::dd()->get('https://zoom.us/oauth/authorize?response_type=code&client_id=88qbzpueTkGI66J9dKWd1g&redirect_uri=https://localhost/show&state={userState}');

    }

    public function show(Request $request)
    {
         //dd($request->code);
           $ZOOM_TOKENS=[]; 
           $string=env('ZOOM_CLIENT_ID','').":".env('ZOOM_CLIENT_SECRET','');

    
 // $response =
            $res=Http::withHeaders([    'Authorization'=>"Basic ".base64_encode($string),
                                        // 'Content-Type' => 'application/x-www-form-urlencoded'
                                              
                                            ])->asForm()->post('https://zoom.us/oauth/token',[

                                                'grant_type'   =>'authorization_code',
                                                'code'         =>$request->code,
                                                'redirect_uri' =>env('ZOOM_CALLBACK','')
                                             ]);


             $resp=$res->json();
            //return collect($resp)->first();

            return Http::withToken(collect($resp)->first())->get('https://api.zoom.us/v2/users');
           
    }
}
