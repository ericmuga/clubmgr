<?php


namespace App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\MeetingController as Meeting;
use App\Http\Controllers\RegistrantController as Registrant;
use App\Http\Controllers\ParticipantController as Participant;
use App\Http\Controllers\InstanceController as Instance;
use App\Http\Controllers\OccurrenceController as Occurrence;
use Illuminate\Support\Facades\Http;


Class Zoom {


   public static function getToken(Request $request){

      if ($request->session()->has('z_tk_time')) {

           $tokenTime=$request->session()->get('z_tk_time');
           if ($tokenTime->diffInMinutes(Carbon::now())>=60) {

            return redirect()->back()->with('error','your authorization token has expired, please login to zoom again and retry your activity');
           }
           elseif(!$request->session()->has('z_tk'))
           {
            return redirect()->back()->with('error','Sorry, we couldnt get your authorization token, please login to zoom again and retry your activity');
             
           }

        return $request->session()->get('z_tk');
     }

   }

   public static function callZoom($request,$page_size,$next_page,$url,$mode,$meeting_id,$valueKey,$next_page_key,$qs)
    {
          $token=Zoom::getToken($request);


           //dd($url);
          if($next_page=="") $items=Http::withToken($token)
                                    ->get($url,['page_size'=>$page_size]);
           else
            $items=Http::withToken($token)
                          ->get($url,['page_size'=>$page_size,'next_page_token'=>$next_page]);
 
          
           $obj=collect($items->json());
           //dd($obj);
           // dd(array_key_exists(3,$obj->values()->toArray()));
            //items within the API call

           if(!array_key_exists($valueKey,$obj->values()->toArray())) 
            // if(array_key_exists(2,$obj->values()->toArray()))
            //   return redirect()->back()->with('error',$obj->values()[2]);
            //   else
              return redirect()->back()->with('error','an error occured when making a zoom call, please try to login to zoom again');

            if (collect($obj->values()[$valueKey])->count()<=0) 
            return "";


           //dd($obj->values());
            $next_page=collect($obj->values()[$next_page_key])->first();
           
            foreach (collect($obj->values()[$valueKey]) as  $item) 
            {
                // dd($item);

                switch ($mode) {
                       case 'users':Meeting::createZoomMeeting($item);
                              break;
                    case 'meetings':Meeting::createZoomMeeting($item);
                              break;
                 case 'registrants':Registrant::createZoomRegistrant($meeting_id,$item);                                      
                       break;

                 case 'instanceRegistrants':Instance::createInstanceRegistrant($meeting_id,$item,$qs);                                      
                       break;


                 case 'instanceParticipants':Instance::createInstanceParticipant($meeting_id,$item,$qs);                                      
                       break;

                case 'occurrenceRegistrants':Occurrence::createOccurrenceRegistrant($meeting_id,$item,$qs);                                      
                       break;
                 case 'participants':Participant::createZoomParticipant($meeting_id,$item);                                      
                       break;
                    default:
                        // code...
                        break;
                }
               
            }
         return $next_page;


    }

}