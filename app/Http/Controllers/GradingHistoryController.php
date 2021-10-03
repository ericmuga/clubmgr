<?php

namespace App\Http\Controllers;

use App\Models\GradingHistory;
use App\Models\GradingRule;
use Illuminate\Http\Request;
use Interia\Inertia;
use Carbon\Carbon;
class GradingHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     */

     public function fetchFile(Request $request, $filename)
     {
            $filePath = storage_path().$filename;
       
            dd($filepath);
           if ( ! File::exists($filePath))
           {
               return Response::make("File does not exist.", 404);
           }
       
           $fileContents = File::get($filePath);
       
           return Response::make($fileContents, 200, array('Content-Type' => $mimeType));
     }
    public function index()
    {
        return inertia('Gradings/Index',[
                                          'gradings'=>GradingHistory::orderBy('id','DESC')

                                                                     ->paginate(10)
                                                                     ->through(fn($grading)=>([
                                                                                                    'user_id'=>$grading->user_id,
                                                                                                    'id'=>$grading->id,
                                                                                                    'from'=>$grading->from,
                                                                                                    'to'=>$grading->to,
                                                                                                    'rule'=>GradingRule::firstWhere('id',$grading->grading_rule_id)->rule_name,
                                                                                                    'meeting_id'=>$grading->meeting_id,
                                                                                                    'category'=>$grading->category,
                                                                                                    'downloadurl'=>url('/reports/'.$grading->downloadurl),
                                                                                                    'grading_time'=>Carbon::parse($grading->created_at)->diffForHumans()
                                                                                                        ]))
                                                                                                    ]); 
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
     * @param  \App\Models\GradingHistory  $gradingHistory
     * @return \Illuminate\Http\Response
     */
    public function show(GradingHistory $gradingHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradingHistory  $gradingHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(GradingHistory $gradingHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GradingHistory  $gradingHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GradingHistory $gradingHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradingHistory  $gradingHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradingHistory $gradingHistory)
    {
        //
    }
}
