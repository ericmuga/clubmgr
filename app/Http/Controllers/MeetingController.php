<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Registrant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        return Inertia::render('Meetings/Index',[
                                 'filters' =>$request->all('search','trashed'),
                                "zmeetings"=>Meeting::where('meeting_type','Zoom')->count(),
                                'meetings' => Meeting::with('registrants')
                                ->orderByDesc('start_time')
                                  ->filter($request->only('search', 'trashed'))
                                                     ->paginate(10)
                                                     ->withQueryString()
                                                     ->through(fn($meeting)=>([
                                                                                'id'=>$meeting->id,
                                                                                'meeting_id'=>$meeting->meeting_id,
                                                                                'meeting_type'=>$meeting->meeting_type,
                                                                                 'registrants'=>$meeting->registrants()->count(),
                                                                                 'participants'=>$meeting->participants()->count(),
                                                                                'start_time'=>Carbon::parse($meeting->start_time)->toDateTimeString(),
                                                                                'topic'=>$meeting->topic
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
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function getRegistrants(Request $request)
    {
        
        //fetch from zoom
          



    }

    public function show(Meeting $meeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        
        return Inertia::render('Meetings/Edit',[
                                
                                      "meeting"=>[
                                                "id"=>$meeting->id,
                                                 "uuid"=>$meeting->uuid,
                                                  "meeting_id"=>$meeting->meeting_id,
                                                  "meeting_type"=>$meeting->meeting_type,
                                                  "topic"=>$meeting->topic,
                                                  "start_time"=>Carbon::parse($meeting->start_time)->toDayDateTimeString(),
                                             ]
                                            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $meeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('meetings')->with('success','Meeting Deleted Successfully');
    }
}
