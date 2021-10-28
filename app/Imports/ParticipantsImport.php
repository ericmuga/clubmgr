<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Meeting;
use App\Models\Instance;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class ParticipantsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public $instance;

    public function __construct ($instance_id)
    {
        $this->instance=Instance::find($instance_id);        
    //    dd($this->instance);
    }
    
    public function model(array $row)
    {

        
                //update
               DB::table('participants')->where('instance_uuid',$this->instance->uuid)
                         ->where('user_email',$row[1])->delete();
                     

        return new Participant([
            
              'instance_uuid'=>$this->instance->uuid,
              'meeting_id'=>$this->instance->meeting_id,
              'user_id'=>Str::slug($row[1], '_'),
              'name'=>$row[0],
              'user_email'=>$row[1],
              'join_time'=>$this->instance->official_start_time,
              'leave_time'=>$this->instance->official_end_time,
              'registrant_id'=>Str::slug($row[1], '_'),
              'duration'=>Carbon::parse($this->instance->official_end_time)->diffInMinutes(Carbon::parse($this->instance->official_start_time),true)
            

 

        ]);
    }
}
