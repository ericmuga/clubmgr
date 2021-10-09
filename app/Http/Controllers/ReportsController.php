<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\Participant;
use App\Models\Instance;
use Illuminate\Support\Facades\DB;
class ReportsController extends Controller
{
    public function index()
    {
        $this->getYears();
        return Inertia::render('Reports/Index',['years'=>$this->getYears()]);
    }

    
    public function getYears()
    {   
        $years=collect([]);
        $instances=DB::table('instances')
                     ->select(DB::raw('YEAR(start_time) as Year'))
                     ->join('participants','instances.uuid','=','instance_uuid')
                      ->groupByRaw('Year')->get();
        foreach ($instances as $instance)
        {
         //   if(!push())    
            $years->push(['id'=>$instance->Year,'year'=>$instance->Year]);
        }
     return $years->toArray();
    }

    public function getCategories()
    {
        # code...
    }
}
