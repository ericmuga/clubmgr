<?php

namespace App\Exports;

use App\Models\Instance;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\InstanceController;

class MainCollectionExporter implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    * 
    */

      public $list;

   public function __construct($what)
       {
          $this->list=$what;
       }

    public function collection()
    {
        


       //  $list=InstanceController::attendanceList($this->instance,null);

       //  $m=[
       //      [],
       //      ["total_title"=>"TOTAL","total"=>$list->count()],
       //      ["marked_present_title"=>"MARKED_PRESENT","marked_present"=>$list->where('score',1)->count()],
       //      ["attendance_title"=>"ATTENDANCE %","attenance"=>round($list->where('score',1)->count()/$list->count(),2)],
       //      ["members_title"=>"MEMBERS", "members"=>$list->where('membership','member')->count()],
       //      ["members_present_title"=>"MEMBERS_PRESENT","members_present"=>$list->where('membership','member')->where('score',1)->where('category','Rotarian')->count()],
       //      ["Rotarian_title"=>"ROTARIANS","Rotarian"=>$list->where('category','Rotarian')->count()],
       //      ["Rotarian_present_title"=>"ROTARIANS_PRESENT","Rotarian_present"=>$list->where('category','Rotarian')->where('score',1)->count()],
       //      ["Rotaractor_title"=>"ROTARACTORS","Rotaractor"=>$list->where('category','Rotaractor')->count()],
       //      ["Rotaractor_present_title"=>"ROTARACTORS_PRESENT","Rotaractor_present"=>$list->where('category','Rotaractor')->where('score',1)->count()],
       //      ["guests_title"=>"GUESTS","guests"=>$list->where('category','Guest')->count()],
       //      ["guests_present_title"=>"GUESTS_PRESENT","guests_present"=>$list->where('category','Guest')->where('score',1)->count()]
       //     ];
       
       //  $headings=[
       //              ['MEETING_DATE'=>"MEETING DATE",'MEETIN_DATE_VALUE'=>$this->instance->official_start_time->toDateString()],
       //              [],
       //              ['NAME'=>"NAME",'EMAIL'=>"EMAIL",'CLUB'=>"CLUB",'MEMBERSHIP'=>"MEMBERSHIP","CATEGORY"=>"CATEGORY",'SCORE'=>"SCORE"]

       //            ];
        
       // $list->pull('instance_date');
       // $list=$list->sortBy('name');
       // $list->prepend($headings)->push($m);//->push($meta);
        

        return $this->list;
    }
}
